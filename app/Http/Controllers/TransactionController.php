<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TransactionController extends Controller
{
    /**
     * Display a listing of user transactions.
     */
    public function index(Request $request): View
    {
        /** @var User $user */
        $user = Auth::user();

        $query = $user->transactions()->with('category');

        // Filter by type
        if ($request->filled('type') && in_array($request->type, ['income', 'expense'])) {
            $query->where('type', $request->type);
        }

        // Filter by category
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Search in description
        if ($request->filled('search')) {
            $query->where('description', 'like', '%'.$request->search.'%');
        }

        // Filter by date range
        if ($request->filled('start_date')) {
            $query->whereDate('date', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('date', '<=', $request->end_date);
        }

        $transactions = $query->orderBy('date', 'desc')->orderBy('id', 'desc')->paginate(10)->withQueryString();

        $categories = Category::availableFor($user->id)->orderBy('name')->get();

        return view('transactions.index', [
            'transactions' => $transactions,
            'categories' => $categories,
            'totalIncome' => $user->totalIncome(),
            'totalExpense' => $user->totalExpense(),
            'currentBalance' => $user->currentBalance(),
        ]);
    }

    /**
     * Show the form for creating a new transaction.
     */
    public function create(Request $request): View
    {
        /** @var User $user */
        $user = Auth::user();
        $type = $request->query('type', 'income');
        if (! in_array($type, ['income', 'expense'])) {
            $type = 'income';
        }

        $categories = Category::availableFor($user->id)
            ->where(function ($q) use ($type) {
                $q->where('type', $type)->orWhere('type', 'both');
            })
            ->orderBy('name')
            ->get();

        return view('transactions.create', [
            'type' => $type,
            'categories' => $categories,
            'today' => Carbon::today()->format('Y-m-d'),
        ]);
    }

    /**
     * Store a newly created transaction in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'type' => ['required', 'in:income,expense'],
            'amount' => ['required', 'numeric', 'min:1'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'custom_category_name' => ['nullable', 'string', 'max:50'],
            'date' => ['required', 'date'],
            'description' => ['nullable', 'string', 'max:500'],
        ]);

        // If user provided a new category name on the fly
        $categoryId = $validated['category_id'] ?? null;
        if (! empty($validated['custom_category_name'])) {
            $newCat = Category::create([
                'user_id' => $user->id,
                'name' => trim($validated['custom_category_name']),
                'type' => $validated['type'],
                'color' => $validated['type'] === 'income' ? '#10b981' : '#f43f5e',
                'icon' => 'tag',
            ]);
            $categoryId = $newCat->id;
        }

        $user->transactions()->create([
            'category_id' => $categoryId,
            'type' => $validated['type'],
            'amount' => $validated['amount'],
            'date' => $validated['date'],
            'description' => $validated['description'] ?? null,
        ]);

        $typeName = $validated['type'] === 'income' ? 'Pemasukan' : 'Pengeluaran';

        return redirect()->route('transactions.index')->with('success', "Catatan {$typeName} berhasil ditambahkan!");
    }

    /**
     * Show the form for editing the specified transaction.
     */
    public function edit(Transaction $transaction): View
    {
        /** @var User $user */
        $user = Auth::user();

        // Enforce ownership: user only edits their own transaction
        if ($transaction->user_id !== $user->id) {
            abort(403, 'Akses ditolak: Anda tidak memiliki akses ke transaksi ini.');
        }

        $categories = Category::availableFor($user->id)
            ->where(function ($q) use ($transaction) {
                $q->where('type', $transaction->type)->orWhere('type', 'both');
            })
            ->orderBy('name')
            ->get();

        return view('transactions.edit', [
            'transaction' => $transaction,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified transaction in storage.
     */
    public function update(Request $request, Transaction $transaction): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        if ($transaction->user_id !== $user->id) {
            abort(403, 'Akses ditolak: Anda tidak memiliki izin memperbarui transaksi ini.');
        }

        $validated = $request->validate([
            'type' => ['required', 'in:income,expense'],
            'amount' => ['required', 'numeric', 'min:1'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'custom_category_name' => ['nullable', 'string', 'max:50'],
            'date' => ['required', 'date'],
            'description' => ['nullable', 'string', 'max:500'],
        ]);

        $categoryId = $validated['category_id'] ?? null;
        if (! empty($validated['custom_category_name'])) {
            $newCat = Category::create([
                'user_id' => $user->id,
                'name' => trim($validated['custom_category_name']),
                'type' => $validated['type'],
                'color' => $validated['type'] === 'income' ? '#10b981' : '#f43f5e',
                'icon' => 'tag',
            ]);
            $categoryId = $newCat->id;
        }

        $transaction->update([
            'category_id' => $categoryId,
            'type' => $validated['type'],
            'amount' => $validated['amount'],
            'date' => $validated['date'],
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()->route('transactions.index')->with('success', 'Catatan transaksi berhasil diperbarui!');
    }

    /**
     * Remove the specified transaction from storage.
     */
    public function destroy(Transaction $transaction): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        if ($transaction->user_id !== $user->id) {
            abort(403, 'Akses ditolak: Anda tidak berhak menghapus transaksi ini.');
        }

        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Catatan transaksi berhasil dihapus!');
    }
}

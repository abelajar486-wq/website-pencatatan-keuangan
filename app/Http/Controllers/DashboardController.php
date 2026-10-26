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

class DashboardController extends Controller
{
    /**
     * Display the user dashboard with financial summaries and charts.
     */
    public function index(Request $request): View
    {
        /** @var User $user */
        $user = Auth::user();

        $totalIncome = $user->totalIncome();
        $totalExpense = $user->totalExpense();
        $currentBalance = $user->currentBalance();

        // Recent transactions (latest 8)
        $recentTransactions = $user->transactions()
            ->with('category')
            ->orderBy('date', 'desc')
            ->orderBy('id', 'desc')
            ->limit(8)
            ->get();

        // Monthly statistics for last 6 months
        $months = [];
        $monthlyIncome = [];
        $monthlyExpense = [];

        for ($i = 5; $i >= 0; $i--) {
            $monthDate = Carbon::now()->subMonths($i);
            $monthKey = $monthDate->translatedFormat('M Y');
            $months[] = $monthKey;

            $inc = (float) $user->transactions()
                ->where('type', 'income')
                ->whereYear('date', $monthDate->year)
                ->whereMonth('date', $monthDate->month)
                ->sum('amount');

            $exp = (float) $user->transactions()
                ->where('type', 'expense')
                ->whereYear('date', $monthDate->year)
                ->whereMonth('date', $monthDate->month)
                ->sum('amount');

            $monthlyIncome[] = $inc;
            $monthlyExpense[] = $exp;
        }

        // Available categories for forms
        $categories = Category::availableFor($user->id)->orderBy('name')->get();

        return view('dashboard', [
            'totalIncome' => $totalIncome,
            'totalExpense' => $totalExpense,
            'currentBalance' => $currentBalance,
            'recentTransactions' => $recentTransactions,
            'chartMonths' => $months,
            'chartIncome' => $monthlyIncome,
            'chartExpense' => $monthlyExpense,
            'categories' => $categories,
        ]);
    }

    /**
     * Top-up user balance (creates an income transaction with Isi Saldo category).
     */
    public function topup(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'amount' => ['required', 'numeric', 'min:1000'],
            'date' => ['nullable', 'date'],
            'description' => ['nullable', 'string', 'max:255'],
        ]);

        /** @var User $user */
        $user = Auth::user();

        $category = Category::firstOrCreate(
            ['name' => 'Isi Saldo / Top Up', 'user_id' => null],
            ['type' => 'income', 'color' => '#10b981', 'icon' => 'wallet']
        );

        $user->transactions()->create([
            'category_id' => $category->id,
            'type' => 'income',
            'amount' => $validated['amount'],
            'date' => $validated['date'] ?? Carbon::today()->format('Y-m-d'),
            'description' => $validated['description'] ?: 'Top Up / Isi Saldo Akun',
        ]);

        return redirect()->route('dashboard')->with('success', 'Saldo berhasil diisi sebesar Rp '.number_format((float) $validated['amount'], 0, ',', '.'));
    }
}

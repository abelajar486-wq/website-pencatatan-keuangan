<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of default and custom categories.
     */
    public function index(): View
    {
        /** @var User $user */
        $user = Auth::user();

        $defaultCategories = Category::whereNull('user_id')
            ->withCount(['transactions' => function ($q) use ($user) {
                $q->where('user_id', $user->id);
            }])
            ->orderBy('type')
            ->orderBy('name')
            ->get();

        $userCategories = Category::where('user_id', $user->id)
            ->withCount('transactions')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('categories.index', [
            'defaultCategories' => $defaultCategories,
            'userCategories' => $userCategories,
        ]);
    }

    /**
     * Store a newly created custom category in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'type' => ['required', 'in:income,expense,both'],
            'color' => ['nullable', 'string', 'max:20'],
            'icon' => ['nullable', 'string', 'max:30'],
        ]);

        $user->categories()->create([
            'name' => trim($validated['name']),
            'type' => $validated['type'],
            'color' => ! empty($validated['color']) ? $validated['color'] : ($validated['type'] === 'income' ? '#10b981' : '#f43f5e'),
            'icon' => ! empty($validated['icon']) ? $validated['icon'] : 'tag',
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori kustom baru berhasil dibuat!');
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy(Category $category): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        if ($category->user_id !== $user->id) {
            abort(403, 'Akses ditolak: Anda hanya dapat menghapus kategori buatan sendiri.');
        }

        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Kategori kustom berhasil dihapus!');
    }
}

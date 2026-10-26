<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            // Income
            ['name' => 'Isi Saldo / Top Up', 'type' => 'income', 'color' => '#10b981', 'icon' => 'wallet'],
            ['name' => 'Gaji & Pendapatan', 'type' => 'income', 'color' => '#06b6d4', 'icon' => 'cash'],
            ['name' => 'Usaha & Bisnis', 'type' => 'income', 'color' => '#3b82f6', 'icon' => 'briefcase'],
            ['name' => 'Investasi & Bunga', 'type' => 'income', 'color' => '#8b5cf6', 'icon' => 'chart-bar'],
            ['name' => 'Bonus & Hadiah', 'type' => 'income', 'color' => '#ec4899', 'icon' => 'gift'],
            ['name' => 'Pemasukan Lainnya', 'type' => 'income', 'color' => '#64748b', 'icon' => 'plus-circle'],

            // Expense
            ['name' => 'Makanan & Minuman', 'type' => 'expense', 'color' => '#f97316', 'icon' => 'cake'],
            ['name' => 'Transportasi & Bensin', 'type' => 'expense', 'color' => '#eab308', 'icon' => 'truck'],
            ['name' => 'Belanja & Keperluan', 'type' => 'expense', 'color' => '#f43f5e', 'icon' => 'shopping-cart'],
            ['name' => 'Tagihan & Langganan', 'type' => 'expense', 'color' => '#ef4444', 'icon' => 'lightning-bolt'],
            ['name' => 'Hiburan & Hobi', 'type' => 'expense', 'color' => '#a855f7', 'icon' => 'sparkles'],
            ['name' => 'Kesehatan & Obat', 'type' => 'expense', 'color' => '#14b8a6', 'icon' => 'heart'],
            ['name' => 'Pendidikan & Kursus', 'type' => 'expense', 'color' => '#6366f1', 'icon' => 'academic-cap'],
            ['name' => 'Pengeluaran Lainnya', 'type' => 'expense', 'color' => '#64748b', 'icon' => 'dots-horizontal'],
        ];

        foreach ($categories as $cat) {
            Category::firstOrCreate(
                ['name' => $cat['name'], 'user_id' => null],
                [
                    'type' => $cat['type'],
                    'color' => $cat['color'],
                    'icon' => $cat['icon'],
                ]
            );
        }
    }
}

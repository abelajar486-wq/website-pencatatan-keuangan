<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // Create Default Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@catatankeuangan.com'],
            [
                'name' => 'Cyber Overlord (Admin)',
                'password' => Hash::make('password'),
                'is_active' => true,
            ]
        );
        $admin->assignRole($adminRole);

        // Create Default User
        $user = User::firstOrCreate(
            ['email' => 'user@catatankeuangan.com'],
            [
                'name' => 'Neon Phantom (User)',
                'password' => Hash::make('password'),
                'is_active' => true,
            ]
        );
        $user->assignRole($userRole);

        // Create Sample Transactions for Default User
        $isiSaldoCat = Category::where('name', 'Isi Saldo / Top Up')->first();
        $gajiCat = Category::where('name', 'Gaji & Pendapatan')->first();
        $makanCat = Category::where('name', 'Makanan & Minuman')->first();
        $belanjaCat = Category::where('name', 'Belanja & Keperluan')->first();
        $hiburanCat = Category::where('name', 'Hiburan & Hobi')->first();

        if ($user->transactions()->count() === 0) {
            Transaction::create([
                'user_id' => $user->id,
                'category_id' => $isiSaldoCat?->id,
                'type' => 'income',
                'amount' => 5000000.00,
                'date' => Carbon::now()->subDays(10)->format('Y-m-d'),
                'description' => 'Isi Saldo Awal Vault Dompet',
            ]);

            Transaction::create([
                'user_id' => $user->id,
                'category_id' => $gajiCat?->id,
                'type' => 'income',
                'amount' => 8500000.00,
                'date' => Carbon::now()->subDays(5)->format('Y-m-d'),
                'description' => 'Gaji Project Street Art Design',
            ]);

            Transaction::create([
                'user_id' => $user->id,
                'category_id' => $makanCat?->id,
                'type' => 'expense',
                'amount' => 250000.00,
                'date' => Carbon::now()->subDays(4)->format('Y-m-d'),
                'description' => 'Makan malam ramen obsidian & iced tea',
            ]);

            Transaction::create([
                'user_id' => $user->id,
                'category_id' => $belanjaCat?->id,
                'type' => 'expense',
                'amount' => 750000.00,
                'date' => Carbon::now()->subDays(2)->format('Y-m-d'),
                'description' => 'Cat spray can Montana Black & mask respirasi',
            ]);

            Transaction::create([
                'user_id' => $user->id,
                'category_id' => $hiburanCat?->id,
                'type' => 'expense',
                'amount' => 300000.00,
                'date' => Carbon::now()->subDay()->format('Y-m-d'),
                'description' => 'Tiket Sound Festival Underground',
            ]);
        }
    }
}

<?php

use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use Database\Seeders\CategorySeeder;
use Database\Seeders\RolePermissionSeeder;

beforeEach(function () {
    $this->seed(CategorySeeder::class);
    $this->seed(RolePermissionSeeder::class);
});

test('user can view transactions list', function () {
    $user = User::factory()->create(['is_active' => true]);
    $user->assignRole('user');

    $response = $this->actingAs($user)->get(route('transactions.index'));

    $response->assertOk();
    $response->assertSee('Catatan');
});

test('user can create income transaction', function () {
    $user = User::factory()->create(['is_active' => true]);
    $user->assignRole('user');
    $category = Category::where('type', 'income')->first();

    $response = $this->actingAs($user)->post(route('transactions.store'), [
        'type' => 'income',
        'amount' => 750000,
        'category_id' => $category?->id,
        'date' => now()->format('Y-m-d'),
        'description' => 'Bonus Freelance Coding',
    ]);

    $response->assertRedirect(route('transactions.index'));
    $this->assertDatabaseHas('transactions', [
        'user_id' => $user->id,
        'type' => 'income',
        'amount' => 750000,
        'description' => 'Bonus Freelance Coding',
    ]);
});

test('user can create expense transaction with on-the-fly custom category', function () {
    $user = User::factory()->create(['is_active' => true]);
    $user->assignRole('user');

    $response = $this->actingAs($user)->post(route('transactions.store'), [
        'type' => 'expense',
        'amount' => 120000,
        'custom_category_name' => 'Beli Kaos Distro',
        'date' => now()->format('Y-m-d'),
        'description' => 'Kaos band underground',
    ]);

    $response->assertRedirect(route('transactions.index'));

    // Check custom category created
    $this->assertDatabaseHas('categories', [
        'user_id' => $user->id,
        'name' => 'Beli Kaos Distro',
        'type' => 'expense',
    ]);

    // Check transaction created
    $this->assertDatabaseHas('transactions', [
        'user_id' => $user->id,
        'type' => 'expense',
        'amount' => 120000,
        'description' => 'Kaos band underground',
    ]);
});

test('user can edit their own transaction', function () {
    $user = User::factory()->create(['is_active' => true]);
    $user->assignRole('user');

    $tx = Transaction::create([
        'user_id' => $user->id,
        'type' => 'expense',
        'amount' => 50000,
        'date' => now()->format('Y-m-d'),
        'description' => 'Makan Siang',
    ]);

    $response = $this->actingAs($user)->put(route('transactions.update', $tx), [
        'type' => 'expense',
        'amount' => 65000,
        'date' => now()->format('Y-m-d'),
        'description' => 'Makan Siang Komplit',
    ]);

    $response->assertRedirect(route('transactions.index'));
    $this->assertDatabaseHas('transactions', [
        'id' => $tx->id,
        'amount' => 65000,
        'description' => 'Makan Siang Komplit',
    ]);
});

test('user cannot edit another user transaction', function () {
    $userA = User::factory()->create(['is_active' => true]);
    $userA->assignRole('user');

    $userB = User::factory()->create(['is_active' => true]);
    $userB->assignRole('user');

    $txB = Transaction::create([
        'user_id' => $userB->id,
        'type' => 'income',
        'amount' => 1000000,
        'date' => now()->format('Y-m-d'),
        'description' => 'Uang Rahasia B',
    ]);

    $response = $this->actingAs($userA)->put(route('transactions.update', $txB), [
        'type' => 'income',
        'amount' => 500,
        'date' => now()->format('Y-m-d'),
        'description' => 'Hacked',
    ]);

    $response->assertForbidden();
    $this->assertDatabaseHas('transactions', [
        'id' => $txB->id,
        'amount' => 1000000,
        'description' => 'Uang Rahasia B',
    ]);
});

test('user cannot delete another user transaction', function () {
    $userA = User::factory()->create(['is_active' => true]);
    $userA->assignRole('user');

    $userB = User::factory()->create(['is_active' => true]);
    $userB->assignRole('user');

    $txB = Transaction::create([
        'user_id' => $userB->id,
        'type' => 'income',
        'amount' => 1000000,
        'date' => now()->format('Y-m-d'),
        'description' => 'Uang Rahasia B',
    ]);

    $response = $this->actingAs($userA)->delete(route('transactions.destroy', $txB));

    $response->assertForbidden();
    $this->assertDatabaseHas('transactions', [
        'id' => $txB->id,
    ]);
});

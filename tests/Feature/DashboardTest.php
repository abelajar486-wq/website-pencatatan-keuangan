<?php

use App\Models\User;
use Database\Seeders\CategorySeeder;
use Database\Seeders\RolePermissionSeeder;

beforeEach(function () {
    $this->seed(CategorySeeder::class);
    $this->seed(RolePermissionSeeder::class);
});

test('authenticated user can view dashboard', function () {
    $user = User::factory()->create(['is_active' => true]);
    $user->assignRole('user');

    $response = $this->actingAs($user)->get(route('dashboard'));

    $response->assertOk();
    $response->assertSee('VAULT TERMINAL');
    $response->assertSee('SALDO SAAT INI');
});

test('user can top up balance successfully', function () {
    $user = User::factory()->create(['is_active' => true]);
    $user->assignRole('user');

    $response = $this->actingAs($user)->post(route('saldo.topup'), [
        'amount' => 1500000,
        'date' => now()->format('Y-m-d'),
        'description' => 'Top Up Modal Usaha',
    ]);

    $response->assertRedirect(route('dashboard'));
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('transactions', [
        'user_id' => $user->id,
        'type' => 'income',
        'amount' => 1500000,
        'description' => 'Top Up Modal Usaha',
    ]);
});

test('deactivated user is logged out and cannot access dashboard', function () {
    $user = User::factory()->create(['is_active' => false]);
    $user->assignRole('user');

    $response = $this->actingAs($user)->get(route('dashboard'));

    $response->assertRedirect(route('login'));
    $this->assertGuest();
});

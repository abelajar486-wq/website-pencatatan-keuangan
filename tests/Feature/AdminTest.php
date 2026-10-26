<?php

use App\Models\User;
use Database\Seeders\CategorySeeder;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Support\Facades\Hash;

beforeEach(function () {
    $this->seed(CategorySeeder::class);
    $this->seed(RolePermissionSeeder::class);
});

test('regular user cannot access admin users list', function () {
    $user = User::factory()->create(['is_active' => true]);
    $user->assignRole('user');

    $response = $this->actingAs($user)->get(route('admin.users.index'));

    $response->assertForbidden();
});

test('admin can access admin users list', function () {
    $admin = User::factory()->create(['is_active' => true]);
    $admin->assignRole('admin');

    $response = $this->actingAs($admin)->get(route('admin.users.index'));

    $response->assertOk();
    $response->assertSee('Manajemen');
    $response->assertSee('Daftar Akun Pengguna Terdaftar');
});

test('admin can toggle user active status to deactivated', function () {
    $admin = User::factory()->create(['is_active' => true]);
    $admin->assignRole('admin');

    $targetUser = User::factory()->create(['is_active' => true]);
    $targetUser->assignRole('user');

    $response = $this->actingAs($admin)->patch(route('admin.users.toggle', $targetUser));

    $response->assertRedirect();
    expect($targetUser->fresh()->is_active)->toBeFalse();
});

test('deactivated user cannot log in', function () {
    $user = User::factory()->create([
        'email' => 'blocked@test.com',
        'password' => Hash::make('secret123'),
        'is_active' => false,
    ]);
    $user->assignRole('user');

    $response = $this->post(route('login'), [
        'email' => 'blocked@test.com',
        'password' => 'secret123',
    ]);

    $response->assertSessionHasErrors('email');
    $this->assertGuest();
});

test('admin cannot deactivate themselves', function () {
    $admin = User::factory()->create(['is_active' => true]);
    $admin->assignRole('admin');

    $response = $this->actingAs($admin)->patch(route('admin.users.toggle', $admin));

    $response->assertSessionHas('error');
    expect($admin->fresh()->is_active)->toBeTrue();
});

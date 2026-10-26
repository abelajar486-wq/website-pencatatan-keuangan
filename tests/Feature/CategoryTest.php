<?php

use App\Models\Category;
use App\Models\User;
use Database\Seeders\CategorySeeder;
use Database\Seeders\RolePermissionSeeder;

beforeEach(function () {
    $this->seed(CategorySeeder::class);
    $this->seed(RolePermissionSeeder::class);
});

test('user can view category list', function () {
    $user = User::factory()->create(['is_active' => true]);
    $user->assignRole('user');

    $response = $this->actingAs($user)->get(route('categories.index'));

    $response->assertOk();
    $response->assertSee('Kategori Standar Sistem');
});

test('user can create custom category', function () {
    $user = User::factory()->create(['is_active' => true]);
    $user->assignRole('user');

    $response = $this->actingAs($user)->post(route('categories.store'), [
        'name' => 'Skateboard Parts',
        'type' => 'expense',
        'color' => '#f97316',
    ]);

    $response->assertRedirect(route('categories.index'));
    $this->assertDatabaseHas('categories', [
        'user_id' => $user->id,
        'name' => 'Skateboard Parts',
        'type' => 'expense',
    ]);
});

test('user can delete their own custom category', function () {
    $user = User::factory()->create(['is_active' => true]);
    $user->assignRole('user');

    $customCat = Category::create([
        'user_id' => $user->id,
        'name' => 'Hapus Saya Segera',
        'type' => 'expense',
    ]);

    $response = $this->actingAs($user)->delete(route('categories.destroy', $customCat));

    $response->assertRedirect(route('categories.index'));
    $this->assertDatabaseMissing('categories', [
        'id' => $customCat->id,
    ]);
});

test('user cannot delete default system category', function () {
    $user = User::factory()->create(['is_active' => true]);
    $user->assignRole('user');

    $defaultCat = Category::whereNull('user_id')->first();

    $response = $this->actingAs($user)->delete(route('categories.destroy', $defaultCat));

    $response->assertForbidden();
    $this->assertDatabaseHas('categories', [
        'id' => $defaultCat->id,
    ]);
});

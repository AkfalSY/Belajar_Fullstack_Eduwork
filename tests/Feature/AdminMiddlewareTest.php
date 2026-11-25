<?php

use App\Models\User;

it('redirects guests to login from the dashboard', function () {
    $this->get(route('dashboard.index'))
        ->assertRedirect(route('login'));
});

it('forbids non-admin users from the dashboard', function () {
    $user = User::factory()->create(['role' => 'customer']);

    $this->actingAs($user)
        ->get(route('dashboard.index'))
        ->assertForbidden();
});

it('allows admin users to view the dashboard', function () {
    $user = User::factory()->create(['role' => 'admin']);

    $this->actingAs($user)
        ->get(route('dashboard.index'))
        ->assertOk();
});

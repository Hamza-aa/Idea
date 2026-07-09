<?php

// use Illuminate\Foundation\Testing\RefreshDatabase;

// uses(RefreshDatabase::class);

use App\Models\User;

it('logs in a user', function () {
    $user = User::factory()->create(['password' => bcrypt('password1122')]);
    visit('/login')
        ->fill('email', $user->email)
        ->fill('password', 'password1122')
        ->click('[data-test="login-button"]')
        ->assertPathIs('/');

    $this->assertAuthenticated();

});

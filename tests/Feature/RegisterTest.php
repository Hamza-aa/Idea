<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('registers a user', function () {
    visit('/register')
        ->fill('name', 'Darya')
        ->fill('email', 'darya@koya.com')
        ->fill('password', 'password1122')
        ->press('Create Account')
        ->assertPathIs('/ideas');

    $this->assertAuthenticated();

});

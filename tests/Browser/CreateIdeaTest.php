<?php

use App\Models\Idea;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);
it('can create an idea', function () {
    $this->actingAs(User::factory()->create());

    visit('/ideas')
        ->click('@create-idea-button')
        ->fill('title', 'Test Idea')
        ->click('@button-status-completed')
        ->fill('description', 'This is a test idea')
        ->fill('@new-link', 'https://google.com')
        ->click('@add-link')
        ->click('Create')
        ->assertPathIs('/ideas');

    expect(Idea::count())->toBe(1);

});

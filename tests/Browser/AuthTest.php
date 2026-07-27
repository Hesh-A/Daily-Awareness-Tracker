<?php
use App\Models\User;

it('register a user successfully', function () {

  // when I register a user
     visit('/register')
        ->fill('name', 'John Doe')
        ->fill('email', 'john@example.com')
        ->fill('password', 'password')
        ->fill('password_confirmation', 'password')
        ->press('Register')
        ->assertPathIs('/dashboard');

    // user count should be 1
    expect(User::count())->toBe(1);
    $this->assertAuthenticated();

    // user should be authenticated



});

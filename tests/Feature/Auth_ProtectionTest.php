<?php

use App\Models\User;
use function Pest\Laravel\get;
use function Pest\Laravel\actingAs;

it('redirects guests to login', function () {
    get('/daily-entries')->assertRedirect('/login');
});

it('allows authenticated users to access daily entries', function () {
    $user = User::factory()->create();
    actingAs($user);

    get('/daily-entries')->assertOk();
});

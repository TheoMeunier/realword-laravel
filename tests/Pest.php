<?php

use App\Auth\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

pest()->extend(TestCase::class)
    ->use(RefreshDatabase::class)
    ->in('Feature', 'Unit');

function actingAsUser(?User $user = null): User
{
    $user ??= User::factory()->create();
    test()->actingAs($user, 'api');

    return $user;
}

<?php

use App\Auth\Models\User;

describe('Show profile', function () {
    it('returns a user profile', function () {
        $me = actingAsUser();
        User::factory()->create(['username' => 'johndoe']);

        $this->getJson('/api/profile/johndoe')
            ->assertOk()
            ->assertJsonStructure([
                'profile' => ['username', 'bio', 'image', 'following'],
            ])
            ->assertJsonPath('profile.username', 'johndoe')
            ->assertJsonPath('profile.following', false);
    });

    it('shows following as true when auth user follows the profile', function () {
        $me = actingAsUser();
        $target = User::factory()->create(['username' => 'johndoe']);
        $me->following()->attach($target->id);

        $this->getJson('/api/profile/johndoe')
            ->assertOk()
            ->assertJsonPath('profile.following', true);
    });

    it('returns 404 for non-existent profile', function () {
        actingAsUser();

        $this->getJson('/api/profile/nobody')->assertStatus(404);
    });

    it('returns 401 when unauthenticated', function () {
        User::factory()->create(['username' => 'johndoe']);

        $this->getJson('/api/profile/johndoe')->assertStatus(401);
    });
});

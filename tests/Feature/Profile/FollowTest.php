
<?php

use App\Auth\Models\User;

describe('Follow', function () {
    it('can follow a user', function () {
        $me = actingAsUser();
        $target = User::factory()->create(['username' => 'johndoe']);

        $this->postJson('/api/profile/johndoe/follow')
            ->assertOk()
            ->assertJsonPath('profile.following', true);

        expect($me->following()->where('followed_id', $target->id)->exists())->toBeTrue();
    });

    it('following the same user twice does not create duplicates', function () {
        $me = actingAsUser();
        User::factory()->create(['username' => 'johndoe']);

        $this->postJson('/api/profile/johndoe/follow');
        $this->postJson('/api/profile/johndoe/follow');

        expect($me->following()->count())->toBe(1);
    });

    it('returns 404 when user does not exist', function () {
        actingAsUser();

        $this->postJson('/api/profile/nobody/follow')->assertStatus(404);
    });

    it('returns 401 when unauthenticated', function () {
        User::factory()->create(['username' => 'johndoe']);

        $this->postJson('/api/profile/johndoe/follow')->assertStatus(401);
    });
});

describe('Unfollow', function () {
    it('can unfollow a user', function () {
        $me = actingAsUser();
        $target = User::factory()->create(['username' => 'johndoe']);
        $me->following()->attach($target->id);

        $this->deleteJson('/api/profile/johndoe/follow')
            ->assertOk()
            ->assertJsonPath('profile.following', false);

        expect($me->following()->where('followed_id', $target->id)->exists())->toBeFalse();
    });

    it('unfollowing a non-followed user does nothing', function () {
        $me = actingAsUser();
        User::factory()->create(['username' => 'johndoe']);

        $this->deleteJson('/api/profile/johndoe/follow')->assertOk();

        expect($me->following()->count())->toBe(0);
    });

    it('returns 404 when user does not exist', function () {
        actingAsUser();

        $this->deleteJson('/api/profile/nobody/follow')->assertStatus(404);
    });

    it('returns 401 when unauthenticated', function () {
        User::factory()->create(['username' => 'johndoe']);

        $this->deleteJson('/api/profile/johndoe/follow')->assertStatus(401);
    });
});

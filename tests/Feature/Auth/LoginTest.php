<?php

use App\Auth\Models\User;

describe('Login', function () {
    it('logs in with valid credentials', function () {
        User::factory()->create([
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
        ]);

        $this->postJson('/api/user/login', [
            'email' => 'user@example.com',
            'password' => 'password',
        ])->assertOk()->assertJsonStructure([
            'user' => ['email', 'token', 'username', 'bio', 'image'],
        ]);
    });

    it('returns 401 with wrong password', function () {
        User::factory()->create(['email' => 'user@example.com']);

        $this->postJson('/api/user/login', [
            'email' => 'user@example.com',
            'password' => 'wrong-password',
        ])->assertStatus(401)->assertJsonStructure(['errors' => ['body']]);
    });

    it('returns 401 with non-existent email', function () {
        $this->postJson('/api/user/login', [
            'email' => 'nobody@example.com',
            'password' => 'password',
        ])->assertStatus(401)->assertJsonStructure(['errors' => ['body']]);
    });

    it('returns 422 when email is missing', function () {
        $this->postJson('/api/user/login', [
            'password' => 'password',
        ])->assertStatus(422)->assertJsonStructure(['errors' => ['email']]);
    });

    it('returns 422 when password is missing', function () {
        $this->postJson('/api/user/login', [
            'email' => 'user@example.com',
        ])->assertStatus(422)->assertJsonStructure(['errors' => ['password']]);
    });

    it('returns 422 when email format is invalid', function () {
        $this->postJson('/api/user/login', [
            'email' => 'not-an-email',
            'password' => 'password',
        ])->assertStatus(422)->assertJsonStructure(['errors' => ['email']]);
    });
});

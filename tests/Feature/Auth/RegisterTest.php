<?php

use App\Auth\Models\User;

describe('Register', function () {
    it('register in with valid credentials', function () {
        $this->postJson('/api/user', [
            'username' => 'John Doe',
            'email' => 'user@example.com',
            'password' => 'password',
        ])->assertCreated()->assertJsonStructure([
            'user' => ['email', 'token', 'username', 'bio', 'image'],
        ]);
    });

    it('returns 401 with existent email', function () {
        User::factory()->create([
            'username' => 'John Doe',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
        ]);

        $this->postJson('/api/user', [
            'username' => 'nJohn Doeee',
            'email' => 'user@example.com',
            'password' => 'password',
        ])->assertStatus(422)->assertJsonStructure(['errors' => ['email']]);
    });

    it('returns 422 when email is missing', function () {
        $this->postJson('/api/user', [
            'username' => 'John Doe',
            'password' => 'password',
        ])->assertStatus(422)->assertJsonStructure(['errors' => ['email']]);
    });

    it('returns 422 when password is missing', function () {
        $this->postJson('/api/user', [
            'username' => 'John Doe',
            'email' => 'user@example.com',
        ])->assertStatus(422)->assertJsonStructure(['errors' => ['password']]);
    });

    it('returns 422 when email format is invalid', function () {
        $this->postJson('/api/user', [
            'username' => 'John Doe',
            'email' => 'not-an-email',
            'password' => 'password',
        ])->assertStatus(422)->assertJsonStructure(['errors' => ['email']]);
    });
});

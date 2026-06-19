<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Auth\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'username' => 'testuser',
            'email' => 'test@example.com',
        ]);

        User::factory(9)->create();
    }
}

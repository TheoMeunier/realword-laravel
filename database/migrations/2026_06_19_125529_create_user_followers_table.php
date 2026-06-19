<?php

declare(strict_types=1);

use App\Auth\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_followers', function (Blueprint $table): void {
            $table->foreignIdFor(User::class, 'follower_id')->constrained('users')->onDelete('cascade');
            $table->foreignIdFor(User::class, 'followed_id')->constrained('users')->onDelete('cascade');
            $table->primary(['follower_id', 'followed_id']);
        });

        Schema::table('users', function (Blueprint $table): void {
            $table->dropColumn('following');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_followers');

        Schema::table('users', function (Blueprint $table): void {
            $table->boolean('following')->default(false);
        });
    }
};

<?php

declare(strict_types=1);

namespace App\Articles\Policies;

use App\Articles\Models\Comment;
use App\Auth\Models\User;

class CommentPolicy
{
    public function delete(User $user, Comment $comment): bool
    {
        return $user->id === $comment->user_id;
    }
}

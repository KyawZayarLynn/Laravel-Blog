<?php

namespace App\Policies;

use App\Models\Blog;
use App\Models\Comment;
use App\Models\User;

class CommentPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function edit(User $user,Comment $comment)
    {
        return $user->id == $comment->user_id;
    }
    public function delete(User $user,Comment $comment)
    {
        return $user->id == $comment->user_id;
    }
}

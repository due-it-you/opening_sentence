<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;

class PostPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * 指定された投稿をユーザーが更新可能か判定
     */
    public function update(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }
}

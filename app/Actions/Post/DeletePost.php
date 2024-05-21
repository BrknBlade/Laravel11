<?php

namespace App\Actions\Post;

use App\Models\Post;
use App\Models\User;

class DeletePost
{
    public function handle(Post $post, User $user)
    {
        $post->delete();

        if ($user->hasRole('Admin')) {
            return redirect()->route('admin.posts.index');
        } else {
            return redirect()->route('posts.index');
        }
    }
}

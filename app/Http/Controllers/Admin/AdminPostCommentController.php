<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\PostComment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostCommentRequest;

class AdminPostCommentController extends Controller
{
    public function store(StorePostCommentRequest $request, Post $post)
    {
        $input = $request->safe()->merge([
            'user_id' => Auth::id(),
        ]);

        $post->comments()->create($input->all());

        return redirect()->route('admin.posts.show', $post);
    }

    public function destroy(Post $post, PostComment $comment)
    {
        $comment->delete();

        return redirect()->route('admin.posts.show', $post);
    }
}

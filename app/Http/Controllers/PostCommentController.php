<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostComment;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostCommentRequest;

class PostCommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostCommentRequest $request, Post $post)
    {
        $input = $request->safe()->merge([
            'user_id' => Auth::id()
        ]);

        $post->comments()->create($input->all());

        return redirect()->route('posts.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post, PostComment $comment)
    {
        $comment->delete();

        return redirect()->route('posts.show', $post);
    }
}

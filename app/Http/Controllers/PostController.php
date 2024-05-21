<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Inertia\Inertia;
use App\Actions\Post\DeletePost;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\RedirectResponse;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Posts/Index', [
            'posts' => Post::with('user:id,name')
                ->withCount(['likes', 'likes as is_liked' => function ($query) {
                    $query->where('user_id', Auth::id());
                }])
                ->latest()
                ->get()
                ->map(fn ($post) => [
                    'id' => $post->id,
                    'title' => $post->title,
                    'content' => $post->content,
                    'likesCount' => $post->likes_count,
                    'userName' => $post->user->name,
                    'userId' => $post->user->id,
                    'isLiked' => (bool) $post->is_liked,
                ])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Posts/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        Auth::user()->posts()->create($request->safe()->all());

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return Inertia::render('Posts/Show', [
            'post' => $post->load(['user:id,name']),
            'comments' => $post->comments()->with('user:id,name')->latest()->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return Inertia::render('Posts/Edit', [
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post): RedirectResponse
    {
        $post->update($request->safe()->all());

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post, DeletePost $action, User $user)
    {
        $action->handle($post, $user);
    }

    public function like(Post $post)
    {
        Auth::user()->likes()->syncWithoutDetaching($post->id);
    }

    public function unlike(Post $post)
    {
        Auth::user()->likes()->detach($post->id);
    }
}

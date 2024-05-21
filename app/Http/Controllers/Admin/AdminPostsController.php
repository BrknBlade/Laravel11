<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\User;
use Inertia\Inertia;
use App\Actions\Post\DeletePost;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Admin/Posts/Index', [
            'posts' => Post::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Posts/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        Auth::user()->posts()->create($request->safe()->all());

        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return Inertia::render('Admin/Posts/Show', [
            'post' => $post->load(['user:id,name']),
            'comments' => $post->comments()->with('user:id,name')->latest()->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return Inertia::render('Admin/Posts/Edit', [
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update($request->safe()->all());

        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post, DeletePost $action, User $user)
    {
        $action->handle($post, $user);
    }
}

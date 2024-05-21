<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Bulletin;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Actions\Bulletin\DeleteBulletin;
use App\Enums\BulletinStatus;
use App\Http\Requests\StoreBulletinRequest;
use App\Http\Requests\UpdateBulletinRequest;
use App\Models\BulletinComment;

class AdminBulletinsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Admin/Bulletins/Index', [
            'bulletins' => Bulletin::query()
                ->with(['user:id,name'])
                ->latest()
                ->get()
                ->map(fn ($bulletin) => [
                    'id' => $bulletin->id,
                    'title' => $bulletin->title,
                    'category' => $bulletin->category->name,
                    'content' => $bulletin->content,
                    'status' => [
                        'label' => $bulletin->status->label(),
                        'color' => $bulletin->status->color(),
                    ]
                ])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Bulletins/Create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBulletinRequest $request)
    {
        Auth::user()->bulletins()->create($request->safe()->all());

        return redirect()->route('admin.bulletins.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Bulletin $bulletin)
    {
        return Inertia::render('Admin/Bulletins/Show', [
            'bulletin' => [
                'id' => $bulletin->id,
                'title' => $bulletin->title,
                'content' => $bulletin->content,
                'category' => $bulletin->category->name,
                'content' => $bulletin->content,
                'status' => [
                    'label' => $bulletin->status->label(),
                    'color' => $bulletin->status->color()
                ]
            ],
            'comments' => $bulletin->comments()->with('user:id,name')->latest()->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bulletin $bulletin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBulletinRequest $request, Bulletin $bulletin)
    {
        $bulletin->update($request->safe()->all());

        return redirect()->route('admin.bulletins.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bulletin $bulletin, DeleteBulletin $action, User $user)
    {
        $action->handle($bulletin, $user);
    }
}

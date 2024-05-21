<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Newpaper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Actions\Newpaper\DeleteNewpaper;
use App\Http\Requests\StoreNewpaperRequest;
use App\Http\Requests\UpdateNewpaperRequest;
use App\Models\User;

class NewpaperController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Newpaper::class, 'newspaper');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Newpaper/Index', [
            'noticias' => Newpaper::with(['user:id,name'])->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Newpaper/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNewpaperRequest $request, User $user)
    {
        Auth::user()->news()->create($request->safe()->all());

        return $user->hasRole('Admin')
            ? redirect()->route('admin.panel')
            : redirect()->route('newspaper.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Newpaper $newspaper)
    {
        return Inertia::render('Newpaper/Show', [
            'noticia' => $newspaper
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Newpaper $newspaper)
    {
        return Inertia::render('Newpaper/Edit', [
            'noticia' => $newspaper
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNewpaperRequest $request, Newpaper $newspaper): RedirectResponse
    {
        $newspaper->update($request->safe()->all());

        return redirect()->route('newspaper.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Newpaper $newspaper, DeleteNewpaper $action, User $user)
    {
        $action->handle($newspaper, $user);
    }
}

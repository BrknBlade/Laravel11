<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Newpaper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Actions\Newpaper\DeleteNewpaper;
use App\Http\Requests\StoreNewpaperRequest;
use App\Http\Requests\UpdateNewpaperRequest;

class AdminNewpaperController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Admin/Newpaper/Index', [
            'noticias' => Newpaper::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Newpaper/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNewpaperRequest $request)
    {
        Auth::user()->newspaper()->create($request->safe()->all());

        return redirect()->route('admin.newspaper.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Newpaper $newpaper)
    {
        return Inertia::render('Admin/Newpaper/Show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Newpaper $newspaper)
    {
        return Inertia::render('Admin/Newpaper/Edit', [
            'noticia' => $newspaper
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNewpaperRequest $request, Newpaper $newspaper)
    {
        $newspaper->update($request->safe()->all());

        return redirect()->route('admin.newspaper.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Newpaper $newspaper, DeleteNewpaper $action, User $user)
    {
        $action->handle($newspaper, $user);
    }
}

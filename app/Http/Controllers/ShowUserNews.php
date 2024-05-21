<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShowUserNews extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return Inertia::render('User/News', [
            'noticias' => Auth::user()->news()
                ->latest()
                ->get()
        ]);
    }
}

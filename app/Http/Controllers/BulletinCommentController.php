<?php

namespace App\Http\Controllers;

use App\Models\BulletinComment;
use App\Http\Requests\StoreBulletinCommentRequest;
use App\Models\Bulletin;
use Illuminate\Support\Facades\Auth;

class BulletinCommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBulletinCommentRequest $request, Bulletin $bulletin)
    {
        $input = $request->safe()->merge([
            'user_id' => Auth::id()
        ]);
        $bulletin->comments()->create($input->all());

        return redirect()->route('bulletins.show', $bulletin);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BulletinComment $bulletinComment)
    {
        dd('destroy');
    }
}

<?php

namespace App\Actions\Newpaper;

use App\Models\User;
use App\Models\Newpaper;

class DeleteNewpaper
{
    public function handle(Newpaper $newspaper, User $user)
    {
        $newspaper->delete();

        if ($user->hasRole('Admin')) {
            return redirect()->route('admin.newspaper.index');
        } else {
            return redirect()->route('newspaper.index');
        }
    }
}

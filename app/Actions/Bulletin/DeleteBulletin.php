<?php

namespace App\Actions\Bulletin;

use App\Models\User;
use App\Models\Bulletin;

class DeleteBulletin
{
    public function handle(Bulletin $bulletin, User $user)
    {
        $bulletin->delete();

        if ($user->hasRole('Admin')) {
            return redirect()->route('admin.bulletins.index');
        } else {
            return redirect()->route('bulletins.index');
        }
    }
}

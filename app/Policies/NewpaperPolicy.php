<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Newpaper;
use Illuminate\Auth\Access\Response;

class NewpaperPolicy
{
    /**
     * Perform pre-authorization checks.
     */
    /* public function before(User $user, string $ability): bool|null
    {
        if ($user->hasRole('superadmin')) {
            return true;
        }

        return null;
    } */

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Newpaper $newspaper): Response
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return $user->hasRole('Admin')
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Newpaper $newspaper): Response
    {
        return $user->id === $newspaper->user_id
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Newpaper $newspaper): Response
    {
        return $user->id === $newspaper->user_id
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Newpaper $newspaper): Response
    {
        return $user->id === $newspaper->user_id
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Newpaper $newspaper): Response
    {
        return $user->id === $newspaper->user_id
            ? Response::allow()
            : Response::denyAsNotFound();
    }
}

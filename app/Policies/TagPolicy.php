<?php

namespace App\Policies;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TagPolicy
{


    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        return  $user->role === 'admin'  ? Response::allow() : Response::deny('You Do Not Permission To Create New Tags.');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Tag $tag)
    {
        return  $user->role === 'admin'  ? Response::allow() : Response::deny('You Do Not Permission To Proform This action.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Tag $tag)
    {
        return  $user->role === 'admin'  ? Response::allow() : Response::deny('You Do Not Permission To Proform This action.');
    }
}

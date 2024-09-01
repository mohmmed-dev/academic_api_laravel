<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user,User $model)
    {
        return  $user->role === 'admin'  ? Response::allow() : Response::deny('You Do Not Permission To Create New Users.');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model)
    {
        return $user->id === $model->id || $user->role === 'admin'  ? Response::allow() : Response::deny('You Do Not Permission To Proform This action.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model)
    {
        return $user->id === $model->id || $user->role === 'admin'  ? Response::allow() : Response::deny('You Do Not Permission To Proform This action.');
    }

}

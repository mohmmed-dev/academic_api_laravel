<?php

namespace App\Policies;

use App\Models\Lesson;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class LessonPolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Lesson $lesson)
    {
        return $user->id === $lesson->user->id || $user->role === 'admin'  ? Response::allow() : Response::deny('You Do Not Permission To Proform This action.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Lesson $lesson)
    {
         return $user->id === $lesson->user->id || $user->role === 'admin'  ? Response::allow() : Response::deny('You Do Not Permission To Proform This action.');
    }
}

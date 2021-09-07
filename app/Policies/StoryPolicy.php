<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Story;
use Illuminate\Auth\Access\HandlesAuthorization;

class StoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Story  $story
     * @return mixed
     */
    public function update(User $user, Story $story)
    {
        return $user->id === $story->users_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Story  $story
     * @return mixed
     */
    public function delete(User $user, Story $story)
    {
        return $user->id === $story->users_id;
    }
}

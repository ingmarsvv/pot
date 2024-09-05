<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Video;
use Illuminate\Auth\Access\Response;

class VideoPolicy
{

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if ($user->name === 'admin'){
            return true;
        } 
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        if ($user->name === 'admin'){
            return true;
        } 
        return false;  
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        if ($user->name === 'admin'){
            return true;
        } 
        return false; 
    }
}

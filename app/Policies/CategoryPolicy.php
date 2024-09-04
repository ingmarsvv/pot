<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CategoryPolicy
{
    public function before(User $user): bool|null
    {
        if ($user->name === 'admin'){
            return true;
        } 
        return null;   
    }
    
    /**
     * Determine whether the user can create models.
     */
    public function create(): bool
    {
        return false;
    }

    
  
}

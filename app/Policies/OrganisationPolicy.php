<?php

namespace App\Policies;

use App\Models\Organisation;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class OrganisationPolicy
{
    /**
    * Determine whether the user can view any models.
    */
    public function viewAny(User $user): bool
    {
        if (isset(auth()->user()->roles[0]->name) && auth()->user()->roles[0]->name == "Normal admin") {
            
            return false;
            
        }elseif (isset(auth()->user()->roles[0]->name) && auth()->user()->roles[0]->name == "Accounts") {
            
            return false;
            
        }else{
            
            return true;
        }
    }
    
    /**
    * Determine whether the user can view the model.
    */
    public function view(User $user, Organisation $organisation): bool
    {
        return true;
    }
    
    /**
    * Determine whether the user can create models.
    */
    public function create(User $user): bool
    {
        return true;
    }
    
    /**
    * Determine whether the user can update the model.
    */
    public function update(User $user, Organisation $organisation): bool
    {
        return true;
    }
    
    /**
    * Determine whether the user can delete the model.
    */
    public function delete(User $user, Organisation $organisation): bool
    {
        return true;
    }
    
    /**
    * Determine whether the user can restore the model.
    */
    public function restore(User $user, Organisation $organisation): bool
    {
        return true;
    }
    
    /**
    * Determine whether the user can permanently delete the model.
    */
    public function forceDelete(User $user, Organisation $organisation): bool
    {
        return true;
    }
}

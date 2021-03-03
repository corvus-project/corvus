<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MenuPolicy
{
    use HandlesAuthorization;

    protected $backend_roles = ['administrator', 'orders_staff', 'inventory_staff'];

    protected $portal_roles = ['customer', 'vendor'];

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    
    public function canAccessCustomer(User $user)
    {
        if ($user->hasRoles($this->portal_roles)){
            return true;
        }  
        return false;
    }

    public function canAccessBackend(User $user)
    {
        if ($user->hasRoles($this->backend_roles)){
            return true;
        }  
        return false;
    }
}

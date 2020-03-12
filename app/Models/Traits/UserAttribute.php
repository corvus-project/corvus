<?php
 

namespace App\Models\Traits;

trait UserAttribute
{
    public function getUserRoleAttribute()
    {
        $role = [];
        $role = $this->roles ? $this->roles->first() : 'No role';
        return $role['display_name']; 
    }

    

    public function getAccountNumberAttribute()
    {
        if ($this->profile){
            return $this->profile->account_number;
        }
        return '---';
    }

    public function getAccountGroupAttribute()
    {
        if ($this->profile){
            return $this->profile->account_group;
        }
        return '---';
    }    
}

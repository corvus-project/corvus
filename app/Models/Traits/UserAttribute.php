<?php
 

namespace App\Models\Traits;

trait UserAttribute
{
    public function getCompanyNameAttribute()
    {
        if ($this->company) {
            return $this->company->name;
        }
        return '';
    }

    public function getUserRoleAttribute()
    {
        $role = [];
        $role = $this->roles ? $this->roles->first() : 'No role';
        return $role['display_name']; 
    }
}

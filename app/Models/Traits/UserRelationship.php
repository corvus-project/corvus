<?php
namespace App\Models\Traits;


use App\Models\Role;
use App\Models\Profile; 

trait UserRelationship{

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
}
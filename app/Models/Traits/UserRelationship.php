<?php
namespace App\Models\Traits;

use App\Models\Order;
use App\Models\Role;
use App\Models\Profile; 

trait UserRelationship{

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }    

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
}
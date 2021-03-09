<?php

namespace Corvus\Core\Models\Traits;

use Corvus\Core\Models\Order;
use Corvus\Core\Models\Role;
use Corvus\Core\Models\Profile;

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

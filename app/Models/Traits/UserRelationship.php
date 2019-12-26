<?php
namespace App\Models\Traits;


use App\Models\Role;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Service;
use App\Models\TimePlan;

trait UserRelationship{

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'service_team')
                ->withPivot(['service_id', 'user_id'])
                ->withTimestamps();
    }

    public function working_hours()
    {
        return $this->hasMany(TimePlan::class, 'user_id', 'id');
    }

}
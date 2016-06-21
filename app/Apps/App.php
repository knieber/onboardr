<?php

namespace Onboardr\Apps;

use Illuminate\Database\Eloquent\Model;
use Onboardr\Organizations\Organization;
use Onboardr\Roles\Role;

class App extends Model
{
    public function organizations()
    {
        $this->belongsToMany(Organization::class);
    }

    public function roles()
    {
        $this->belongsToMany(Role::class);
    }
}
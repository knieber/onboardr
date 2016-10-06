<?php

namespace Onboardr\Apps;

use Illuminate\Database\Eloquent\Model;
use Onboardr\Organizations\Organization;
use Onboardr\Roles\Role;

class App extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany | Organization
     */
    public function organizations()
    {
        return $this->belongsToMany(Organization::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany | Role
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
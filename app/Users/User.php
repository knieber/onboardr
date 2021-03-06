<?php

namespace Onboardr\Users;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Onboardr\Organizations\Organization;
use Onboardr\Roles\Role;

class User extends Authenticatable
{
    protected $fillable = ['name', 'password', 'email'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function organizations()
    {
        return $this->belongsToMany(Organization::class)->withPivot('user_type');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
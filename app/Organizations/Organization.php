<?php

namespace Onboardr\Organizations;

use Illuminate\Database\Eloquent\Model;
use Onboardr\Apps\App;
use Onboardr\Roles\Role;
use Onboardr\Users\User;

class Organization extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'key'
    ];

    /**
     * Get the roles belonging to the organization
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function roles()
    {
        return $this->hasMany(Role::class);
    }

    /**
     * Return all apps that are associated to the organization
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function apps()
    {
        return $this->belongsToMany(App::class);
    }

    /**
     * Return all users that are associated the organization
     *
     * @return $this
     */
    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('user_type');
    }
}
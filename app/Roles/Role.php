<?php

namespace Onboardr\Roles;

use Illuminate\Database\Eloquent\Model;
use Onboardr\Apps\App;

class Role extends Model
{
    /**
     * Mass assignable properties
     *
     * @var array
     */
    protected $fillable = ['name', 'organization_id'];

    /**
     * Get apps for a role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function apps()
    {
        return $this->belongsToMany(App::class);
    }
}
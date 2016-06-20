<?php

namespace Onboardr\Roles;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * Mass assignable properties
     *
     * @var array
     */
    protected $fillable = ['name', 'organization_id'];
}
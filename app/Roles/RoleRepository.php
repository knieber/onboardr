<?php

namespace Onboardr\Roles;

use Onboardr\Repository;

class RoleRepository extends Repository
{
    /**
     * RoleRepository constructor.
     * @param Role $role
     */
    public function __construct(Role $role)
    {
        parent::__construct($role);
    }
}
<?php

namespace Onboardr\Roles;

use Illuminate\Support\Facades\DB;

class RoleAppOrganizationRepository
{
    /**
     * @param array $data
     * @return void
     */
    public function create(array $data)
    {
        DB::table('role_app_organizations')
            ->insert($data);
    }
}
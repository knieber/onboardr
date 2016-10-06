<?php

namespace Onboardr\Apps;

use Illuminate\Support\Facades\DB;

class AppRoleOrganizationRepository
{
    /**
     * @param array $data
     * @return void
     */
    public function create(array $data)
    {
        DB::table('app_role_organizations')
            ->insert($data);
    }
}
<?php

namespace Onboardr\Users;

use DB;

class UserOrganizationRepository
{
    public function create(array $data)
    {
        DB::table('organization_user')
            ->insert($data);
    }
}
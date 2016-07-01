<?php

namespace Onboardr\Users;

use DB;

class UserToOrganizationRepository
{
    public function create(array $data)
    {
        DB::table('organization_user')
            ->insert($data);
    }
}
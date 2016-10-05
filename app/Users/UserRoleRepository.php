<?php

namespace Onboardr\Users;

use DB;

class UserRoleRepository
{
    public function create(array $data)
    {
        DB::table('role_user')
            ->insert($data);
    }
}
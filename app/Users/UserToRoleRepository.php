<?php

namespace Onboardr\Users;

use DB;

class UserToRoleRepository
{
    public function create(array $data)
    {
        DB::table('role_user')
            ->insert($data);
    }
}
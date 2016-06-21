<?php

namespace Onboardr\Apps;

use Onboardr\Repository;
use DB;

class AppToRoleRepository
{
    public function create(array $data)
    {
        DB::table('app_role')
            ->insert($data);
    }
}
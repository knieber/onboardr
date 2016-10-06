<?php

namespace Onboardr\Apps;

use Onboardr\Repository;
use DB;

class AppRoleRepository extends Repository
{
    /**
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model|void
     */
    public function create(array $data)
    {
        DB::table('app_role')
            ->insert($data);
    }
}
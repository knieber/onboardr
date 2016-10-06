<?php

namespace Onboardr\Apps;

use Illuminate\Support\Facades\DB;

class AppRoleRepository
{
    /**
     * @param array $data
     * @return string $id
     */
    public function create(array $data)
    {
        return DB::table('app_role')
            ->insertGetId($data);
    }
}
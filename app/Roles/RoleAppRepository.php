<?php

namespace Onboardr\Roles;

use Illuminate\Support\Facades\DB;

class RoleAppRepository
{
    /**
     * @param array $data
     * @return string $id
     */
    public function create(array $data)
    {
        return DB::table('role_app')
            ->insertGetId($data);
    }
}
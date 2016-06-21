<?php

namespace Onboardr\Apps;

use Onboardr\Repository;
use DB;

class AppToOrganizationRepository
{
    public function create(array $data)
    {
        DB::table('app_organization')
            ->insert($data);
    }
}
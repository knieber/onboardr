<?php

namespace Onboardr\Organizations;

use Illuminate\Support\Facades\Crypt;
use Onboardr\Repository;

class OrganizationRepository extends Repository
{
    /**
     * OrganizationRepository constructor.
     *
     * @param Organization $organization
     */
    public function __construct(Organization $organization)
    {
        parent::__construct($organization);
    }

    /**
     * @param array $data
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {
        $key = uniqid();

        $data['key'] = $key;

        return parent::create($data);
    }
}
<?php

namespace Onboardr\Apps;

use Onboardr\Repository;

class AppRepository extends Repository
{
    public function __construct(App $app)
    {
        parent::__construct($app);
    }
}
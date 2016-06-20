<?php

namespace Onboardr\Http\Controllers;

use Illuminate\Http\Request;

use Onboardr\Http\Requests;
use Onboardr\Roles\RoleRepository;

class AppsController extends Controller
{
    /**
     * @var RoleRepository
     */
    private $roleRepository;

    /**
     * AppsController constructor.
     * @param RoleRepository $roleRepository
     */
    public function __construct(RoleRepository $roleRepository)
    {

        $this->roleRepository = $roleRepository;
    }

    /**
     * Show the add an app page
     *
     * @param $roleId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($roleId)
    {
        $role = $this->roleRepository->find($roleId);

        return view('apps.create', ['role' => $role]);
    }
}

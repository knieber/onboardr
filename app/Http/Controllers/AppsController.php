<?php

namespace Onboardr\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Onboardr\Apps\AppRepository;
use Onboardr\Apps\AppToOrganizationRepository;
use Onboardr\Apps\AppToRoleRepository;
use Onboardr\Http\Requests;
use Onboardr\Roles\RoleRepository;

class AppsController extends Controller
{
    /**
     * @var RoleRepository
     */
    private $roleRepository;

    /**
     * @var AppToOrganizationRepository
     */
    private $appToOrganizationRepository;

    /**
     * @var AppRepository
     */
    private $appRepository;

    /**
     * @var AppToRoleRepository
     */
    private $appToRoleRepository;

    /**
     * AppsController constructor.
     * @param RoleRepository $roleRepository
     * @param AppToOrganizationRepository $appToOrganizationRepository
     * @param AppToRoleRepository $appToRoleRepository
     * @param AppRepository $appRepository
     */
    public function __construct(RoleRepository $roleRepository,
                                AppToOrganizationRepository $appToOrganizationRepository,
                                AppRepository $appRepository,
                                AppToRoleRepository $appToRoleRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->appToOrganizationRepository = $appToOrganizationRepository;
        $this->appRepository = $appRepository;
        $this->appToRoleRepository = $appToRoleRepository;
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

    public function store($roleId, Request $request)
    {
        $appName = $request->get('app');
        $appEmail = $request->get('app_email');
        $appPassword = $request->get('app_password');

        $app = $this->appRepository->findBy('name', $appName);

        $this->appToOrganizationRepository->create([
            'app_id' => $app->id,
            'organization_id' => Auth::user()->id,
            'app_email' => $appEmail,
            'app_password' => Crypt::encrypt($appPassword)
        ]);

        $this->appToRoleRepository->create([
            'app_id' => $app->id,
            'role_id' => $roleId
        ]);

        return redirect('/app');
    }
}

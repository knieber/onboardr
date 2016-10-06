<?php

namespace Onboardr\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Crypt;
use Onboardr\Apps\AppRepository;
use Onboardr\Apps\AppRoleRepository;
use Onboardr\Http\Requests;
use Onboardr\Roles\RoleRepository;

class AppsController extends Controller
{
    /**
     * @var RoleRepository
     */
    private $roleRepository;

    /**
     * @var AppRepository
     */
    private $appRepository;

    /**
     * @var AppRoleRepository
     */
    private $appToRoleRepository;

    /**
     * AppsController constructor.
     * @param RoleRepository $roleRepository
     * @param AppRoleRepository $appToRoleRepository
     * @param AppRepository $appRepository
     */
    public function __construct(RoleRepository $roleRepository,
                                AppRepository $appRepository,
                                AppRoleRepository $appToRoleRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->appRepository = $appRepository;
        $this->appToRoleRepository = $appToRoleRepository;
    }

    /**
     * Show the add an app page
     *
     * @param Request $request
     * @param $orgId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request, $orgId)
    {
        $roleId = $request->get('role_id');
        $role = $this->roleRepository->find($roleId);

        return view('apps.create', [
            'role' => $role,
            'orgId' => $orgId
        ]);
    }

    /**
     * @param Request $request
     * @param $orgId
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request, $orgId)
    {
        $roleId = $request->get('role_id');
        $appName = $request->get('app');
        $appEmail = $request->get('app_email');
        $appPassword = $request->get('app_password');



        $app = $this->appRepository->findBy('name', $appName);

        $this->appToRoleRepository->create([
            'app_id' => $app->id,
            'role_id' => $roleId,
            'app_email' => $appEmail,
            'app_password' => Crypt::encrypt($appPassword)
        ]);

        return redirect("/app/organization/$orgId/manage");
    }

    public function onboard(Request $request, $id)
    {

    }
}

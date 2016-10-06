<?php

namespace Onboardr\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Crypt;
use Onboardr\Roles\RoleAppOrganizationRepository;
use Onboardr\Apps\AppRepository;
use Onboardr\Roles\RoleAppRepository;
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
     * @var RoleAppRepository
     */
    private $appToRoleRepository;

    /**
     * @var RoleAppOrganizationRepository
     */
    private $appOrgRepo;

    /**
     * AppsController constructor.
     * @param RoleRepository $roleRepository
     * @param AppRepository $appRepository
     * @param RoleAppRepository $appToRoleRepository
     * @param RoleAppOrganizationRepository $appOrgRepo
     */
    public function __construct(RoleRepository $roleRepository,
                                AppRepository $appRepository,
                                RoleAppRepository $appToRoleRepository,
                                RoleAppOrganizationRepository $appOrgRepo)
    {
        $this->roleRepository = $roleRepository;
        $this->appRepository = $appRepository;
        $this->appToRoleRepository = $appToRoleRepository;
        $this->appOrgRepo = $appOrgRepo;
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
        $appOrganizations = explode(',', $request->get('app_organizations'));

        $app = $this->appRepository->findBy('name', $appName);

        $appRoleId = $this->appToRoleRepository->create([
            'app_id' => $app->id,
            'role_id' => $roleId,
            'app_email' => $appEmail,
            'app_password' => Crypt::encrypt($appPassword)
        ]);

        foreach($appOrganizations as $appOrg) {
            $this->appOrgRepo->create([
                'app_role_id' => $appRoleId,
                'name' => $appOrg
            ]);
        }

        return redirect("/app/organization/$orgId/manage");
    }

    public function onBoardView(Request $request, $id)
    {
        return view('apps.onboard', [

        ]);
    }

    public function onBoard(Request $request, $id)
    {

    }
}

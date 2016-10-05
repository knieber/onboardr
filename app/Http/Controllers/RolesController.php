<?php

namespace Onboardr\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Onboardr\Http\Requests;
use Onboardr\Organizations\OrganizationRepository;
use Onboardr\Roles\RoleRepository;
use Onboardr\Users\UserRoleRepository;

class RolesController extends Controller
{
    /**
     * @var RoleRepository
     */
    private $roleRepository;
    /**
     * @var OrganizationRepository
     */
    private $organizationRepo;
    /**
     * @var UserRoleRepository
     */
    private $userToRoleRepo;

    /**
     * RolesController constructor.
     * @param RoleRepository $roleRepository
     * @param OrganizationRepository $organizationRepo
     * @param UserRoleRepository $userToRoleRepo
     */
    public function __construct(RoleRepository $roleRepository,
                                OrganizationRepository $organizationRepo,
                                UserRoleRepository $userToRoleRepo)
    {
        $this->roleRepository = $roleRepository;
        $this->organizationRepo = $organizationRepo;
        $this->userToRoleRepo = $userToRoleRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $orgId
     * @return \Illuminate\Http\Response
     */
    public function create($orgId)
    {
        return view('roles.create', ['orgId' => $orgId]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $orgId
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $orgId)
    {
        $name = $request->get('name');

        $this->roleRepository->create(['name' => $name, 'organization_id' => $orgId]);

        return redirect("/app/organization/$orgId/manage");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function join(Request $request, $orgId)
    {
        $this->userToRoleRepo->create([
            'user_id' => Auth::user()->id,
            'role_id' => $request->get('role')
        ]);

        return redirect("/app/organization/$orgId");
    }

    /**
     * Show the select form
     *
     * @param $orgId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function select($orgId)
    {
        $organization = $this->organizationRepo->find($orgId);

        return view("roles.select", [
            'organization' => $organization,
            'roles' => $organization->roles
        ]);
    }
}

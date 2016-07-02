<?php

namespace Onboardr\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Onboardr\Http\Requests;
use Onboardr\Organizations\OrganizationRepository;
use Onboardr\Users\UserToOrganizationRepository;

class OrganizationController extends Controller
{

    /**
     * @var OrganizationRepository
     */
    private $organizationRepo;
    /**
     * @var UserToOrganizationRepository
     */
    private $userToOrganizationRepo;

    /**
     * OrganizationController constructor.
     * @param OrganizationRepository $organizationRepo
     * @param UserToOrganizationRepository $userToOrganizationRepo
     */
    public function __construct(OrganizationRepository $organizationRepo,
                                UserToOrganizationRepository $userToOrganizationRepo)
    {
        $this->organizationRepo = $organizationRepo;
        $this->userToOrganizationRepo = $userToOrganizationRepo;
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
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('organization.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $organization = $this->organizationRepo->create(['name' => $request->get('name')]);
        $this->userToOrganizationRepo->create([
            'organization_id' => $organization->id,
            'user_id' => Auth::user()->id,
            'user_type' => 'manager'
        ]);

        return redirect("/app/organization/$organization->id/manage");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $organization = $this->organizationRepo->find($id);

        $roles = Auth::user()->roles;

        return view("organization.view", [
            'organization' => $organization,
            'roles' => $roles
        ]);
    }

    /**
     * Display manager view.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function manage($id)
    {
        $organization = $this->organizationRepo->find($id);

        return view("organization.manage", ['organization' => $organization]);
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

    public function pickOrg()
    {
        return view('organization.join');
    }

    public function join(Request $request)
    {
        $key = $request->get('key');

        $organization = $this->organizationRepo->findBy('key', $key);

        $this->userToOrganizationRepo->create([
            'user_id' => Auth::user()->id,
            'organization_id' => $organization->id,
            'user_type' => 'member'
        ]);

        return redirect("/app/organization/$organization->id/select-role");
    }
}

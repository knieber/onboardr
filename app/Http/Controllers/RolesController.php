<?php

namespace Onboardr\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Onboardr\Http\Requests;
use Onboardr\Roles\RoleRepository;

class RolesController extends Controller
{
    /**
     * @var RoleRepository
     */
    private $roleRepository;

    /**
     * RolesController constructor.
     * @param RoleRepository $roleRepository
     */
    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
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
}

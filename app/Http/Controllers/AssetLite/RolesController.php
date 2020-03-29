<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Services\RoleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class RolesController extends Controller
{
    const LEAD_USER = "lead_user";
    const LEAD_USER_ROLE = "lead_user_role";

    /**
     * @var RoleService
     */
    private $roleService;

    /**
     * RolesController constructor.
     * @param RoleService $roleService
     */
    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $type = Auth::user()->type;
        $featureType = Auth::user()->feature_type;
        if ($featureType == self::LEAD_USER) {
            $roles = Role::where('user_type', $type)
                ->where('feature_type', self::LEAD_USER_ROLE)
                ->get();
        } else {
            $roles = Role::where('user_type', $type)->get();
        }

        return view('vendor.authorize.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('vendor.authorize.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $requestData = $request->all();
        $requestData['user_type'] = Auth::user()->type;
        $requestData['feature_type'] = (Auth::user()->feature_type == self::LEAD_USER) ? self::LEAD_USER_ROLE : null;
        Role::create($requestData);
        Session::flash('message', 'Role added!');
        return redirect(Config("authorization.route-prefix") . '/roles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $role = Role::findOrFail($id);

        return view('vendor.authorize.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('vendor.authorize.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {

        $requestData = $request->all();

        $role = Role::findOrFail($id);
        $role->update($requestData);

        Session::flash('flash_message', 'Role updated!');

        return redirect(Config("authorization.route-prefix") . '/roles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Role::destroy($id);

        Session::flash('flash_message', 'Role deleted!');

        return redirect(Config("authorization.route-prefix") . '/roles');
    }
}

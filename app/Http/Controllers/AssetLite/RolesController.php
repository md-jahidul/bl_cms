<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Role;
use Illuminate\Http\Request;
use Session;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $roles = Role::paginate(15);

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
        
        Role::create($requestData);

        Session::flash('flash_message', 'Role added!');

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

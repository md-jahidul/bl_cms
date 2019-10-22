<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Requests\UserStoreRequest;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Http\Controllers\Controller;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userType = Auth::user()->type;
        $users = User::where('type', $userType)->with('roles')->get();
        return view('vendor.authorize.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userType = Auth::user()->type;
        $roles = Role::where('user_type', $userType)->where('alias','!=','assetlite_admin')->get();
        return view('vendor.authorize.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        $user = new User;
        $user->name = request()->name;
        $user->email = request()->email;
        $user->uid = 'Null';
        $user->type = Auth::user()->type;
        $user->phone = '019112' . rand(10000, 99999);
        $user->password = Hash::make(request()->password);
        $user->save();

        foreach (request()->role_id as $role){
            $user->roles()->save(Role::find($role));
        }

        return redirect('authorize/users');
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
        $userType = Auth::user()->type;
        $user = User::findOrFail($id);

//        return Hash::check($user->password);

        $roles = Role::where('user_type', $userType)->where('alias','!=','assetlite_admin')->get();
        return view('vendor.authorize.users.edit', compact('user', 'roles'));
    }

    public function changePasswordForm()
    {
       return view('vendor.authorize.users.change-password');
    }

    public function changePassword(Request $request){

        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        if (!(Hash::check($request->get('old_password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("message","Your current password does not matches with the password you provided. Please try again.");
        }
        if(strcmp($request->get('old_password'), $request->get('password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("message","New Password cannot be same as your current password. Please choose a different password.");
        }

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('password'));
        $user->save();
        return redirect()->back()->with("message","Password changed successfully !");
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
        $user = User::findOrFail($id);
        $user->update($request->all());

        $roles = DB::table('role_user')->where('user_id',$id)->get();

        foreach ($roles as $role){
            $user->roles()->detach($role);
        }

        foreach (request()->role_id as $role){
            $user->roles()->save(Role::find($role));
        }


        return redirect('authorize/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('authorize/users')->with('User delete successfully');
    }
}

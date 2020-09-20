<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\PasswordChangeRequest;
use App\Models\RoleUser;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Validator;
use App\Models\PasswordHistory;
use Carbon\Carbon;

class UserController extends Controller
{
    const LEAD_USER = "lead_user";
    const LEAD_USER_ROLE = "lead_user_role";
    const SUPER_ADMIN = [
        'assetlite_super_Admin' => 5,
        'lead_super_Admin' => 9
    ];

    /***
     * @var UserService
     */
    private $userService;

    /***
     * UserController constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $superAdmin = self::SUPER_ADMIN;
        $userType = Auth::user()->type;
        $featureType = Auth::user()->feature_type;
        if ($featureType == 'lead_user') {
            $users = User::where('type', $userType)
                ->where('feature_type', $featureType)
                ->with('roles')->get();
        } else {
            $users = User::where('type', $userType)->with('roles')->get();
        }

        return view('vendor.authorize.users.index', compact('users', 'superAdmin'));
    }

    /**
     * @return mixed
     */
    private function roleFilter()
    {
        $type = Auth::user()->type;
        $featureType = Auth::user()->feature_type;
        if ($featureType == self::LEAD_USER) {
            $roles = Role::where('user_type', $type)
                ->where('alias', '!=', 'lead_super_admin')
                ->where('feature_type', self::LEAD_USER_ROLE)
                ->get();
        } else {
            $roles = Role::where('user_type', $type)
                ->where('alias', '!=', 'assetlite_super_admin')
                ->get();
        }

        return $roles;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $roles = $this->roleFilter();
//        $roles = Role::where('user_type', $userType)->where('alias', '!=', 'assetlite_super_admin')->get();
        return view('vendor.authorize.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserStoreRequest $request
     * @return Response
     */
    public function store(UserStoreRequest $request)
    {
        $this->userService->storeUser($request);
        $user = new User();
        $user->name = request()->name;
        $user->email = request()->email;
        $user->uid = 'Null';
        $user->type = Auth::user()->type;
        $user->feature_type = (Auth::user()->feature_type == "lead_user") ? "lead_user" : null;
        $user->phone = '019112' . rand(10000, 99999);
        $user->password = Hash::make(request()->password);
        $user->save();

        //entry into password history
        $passwordHistory = PasswordHistory::create([
            'user_id' => $user->id,
            'password' => bcrypt($request->get('password'))
        ]);

        foreach (request()->role_id as $role) {
            $user->roles()->save(Role::find($role));
        }

        return redirect('authorize/users');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
//        $userType = Auth::user()->type;
        $superAdminId = Auth::user()->roles[0]->id;
        $user = User::findOrFail($id);
        $roles = $this->roleFilter();
//        $roles = Role::where('user_type', $userType)->where('alias', '!=', 'assetlite_admin')->get();
        return view('vendor.authorize.users.edit', compact('user', 'roles', 'superAdminId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());

        $roles = DB::table('role_user')->where('user_id', $id)->get();
        foreach ($roles as $role) {
            $user->roles()->detach($role);
        }
        foreach (request()->role_id as $role) {
            $user->roles()->save(Role::find($role));
        }

        return redirect('authorize/users');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View
     */

    public function changePasswordForm()
    {
        return view('vendor.authorize.users.change-password');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @author ahsan habib <ahabib@bs-23.net>
     */
    public function changePassword(Request $request)
    {
        $input = $request->all();
//        echo $request->get('password');
//        echo bcrypt($request->get('password'));
//        dd();
        $rules = [

            'old_password' => 'required',
//            'password' => 'required|regex:/^[a-zA-Z0-9]{8,}.+$/|confirmed|min:6',
        ];

        $messages = [
            'password.required' => 'The :attribute field is required.',
            'password.regex' => 'The :attribute must be more than 8 characters long, should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character.',
        ];
        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        if (!(Hash::check($request->get('old_password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with(
                "error",
                "Your current password does not matches with the password you provided. Please try again."
            )->withInput();
        }

        if (!(Hash::check($request->get('old_password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with(
                "error",
                "Your current password does not matches with the password you provided. Please try again."
            );
        }
        if (strcmp($request->get('old_password'), $request->get('password')) == 0) {
            //Current password and new password are same
            return redirect()->back()->with(
                "error",
                "New Password cannot be same as your current password. Please choose a different password."
            );
        }

        //Check Password History
        $user = Auth::user();
        $passwordHistories = $user->passwordHistories()->take(env('PASSWORD_HISTORY_NUM'))->get();
        foreach ($passwordHistories as $passwordHistory) {
            echo $passwordHistory->password;
            if (Hash::check($request->get('password'), $passwordHistory->password)) {
                // The passwords matches
                return redirect()->back()->with("error", "Your new password can not be same as any of your recent passwords. Please choose a new password.");
            }
        }

        //Change Password
        $user->password = bcrypt($request->get('password'));
        $user->password_changed_at =Carbon::today();;
        $user->save();

        //entry into password history
        $passwordHistory = PasswordHistory::create([
            'user_id' => $user->id,
            'password' => bcrypt($request->get('password'))
        ]);

        return redirect()->back()->with("success", "Password changed successfully !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('authorize/users')->with('User delete successfully');
    }
}

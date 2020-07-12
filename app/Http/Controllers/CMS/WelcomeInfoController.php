<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWelcomeInfoRequest;
use App\Http\Requests\UpdateWelcomeInfoRequest;
use App\Models\WelcomeInfo;
use App\Services\WelcomeInfoService;
use App\Http\Requests\WelcomeInfoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

/**
 * Class WelcomeInfoController
 * @package App\Http\Controllers\CMS
 */
class WelcomeInfoController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $welcomeInfo = WelcomeInfo::first();

        return view('admin.welcomeInfo.create', compact('welcomeInfo'));
    }

    public function store(StoreWelcomeInfoRequest $request)
    {
        $data['image'] = null;
        if ($request->file('image')) {
            $file = $request->image;
            $path = $file->storeAs(
                'welcomeinfo/images',
                strtotime(now()) . '_welcome_image.' . $file->getClientOriginalExtension(),
                'public'
            );

            $data['image'] = $path;
        }

        $data['message_en']         = $request->message_en;
        $data['message_bn']         = $request->message_bn;
        $data['login_button_title'] = $request->login_button_title;
        $data['login_button_title_bn'] = $request->login_button_title_bn;

        WelcomeInfo::create($data);

        return Redirect::back()->with('success', 'Welcome Info added');
    }

    public function update(UpdateWelcomeInfoRequest $request, $id)
    {
        if ($request->file('image')) {
            $file = $request->image;
            $path = $file->storeAs(
                'welcomeinfo/images',
                strtotime(now()) . '_welcome_image.' . $file->getClientOriginalExtension(),
                'public'
            );

            $data['image'] = $path;
        }

        $data['message_en']         = $request->message_en;
        $data['message_bn']         = $request->message_bn;
        $data['login_button_title'] = $request->login_button_title;
        $data['login_button_title_bn'] = $request->login_button_title_bn;

        try {
            $info = WelcomeInfo::findOrFail($id);
            $info->update($data);
        } catch (\Exception $e) {
            return Redirect::back()->with('error', $e->getMessage());
        }

        return Redirect::back()->with('success', 'Welcome Info updated');
    }
}

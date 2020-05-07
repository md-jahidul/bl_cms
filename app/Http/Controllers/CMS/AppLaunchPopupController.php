<?php

namespace App\Http\Controllers\CMS;

use App\Http\Requests\AppLaunchPopupStoreRequest;
use App\Http\Requests\AppLaunchPopupUpdateRequest;
use App\Models\MyBlAppLaunchPopup;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class AppLaunchPopupController
 * @package App\Http\Controllers\CMS
 */
class AppLaunchPopupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('admin.app-launch-popup.create');
    }

    public function store(AppLaunchPopupStoreRequest $request)
    {
        $type = $request->type;
        if ($type == 'image') {
            if (!$request->hasFile('content_data')) {
                return redirect()->back()->with('error', 'Image is required');
            }
            // upload the image
            $file = $request->content_data;
            $path = $file->storeAs(
                'app-launch-popup/images',
                strtotime(now()).'.'.$file->getClientOriginalExtension(),
                'public'
            );

            $data['content'] = $path;
        } else {
            $data['content'] = $request->input('content_data');
        }

        // start date end date
        $date_range_array = explode('-', $request->input('display_period'));
        $data['start_date'] = Carbon::createFromFormat('Y/m/d h:i A', trim($date_range_array[0]), 'Asia/Dhaka')
            ->setTimezone('UTC')->toDateTimeString();
        $data['end_date'] = Carbon::createFromFormat('Y/m/d h:i A', trim($date_range_array[1]), 'Asia/Dhaka')
            ->setTimezone('UTC')->toDateTimeString();

        $data['type'] = $type;
        $data['title'] = $request->title;
        $data['created_by'] = auth()->id();

        MyBlAppLaunchPopup::create($data);

        return redirect()->back()->with('success', 'Successfully Saved');
    }

    public function index()
    {
        $pop_ups = MyBlAppLaunchPopup::paginate(15);

        return view('admin.app-launch-popup.index', compact('pop_ups'));
    }

    public function edit(MyBlAppLaunchPopup $pop_up)
    {
        return view('admin.app-launch-popup.edit', compact('pop_up'));
    }

    public function update(AppLaunchPopupUpdateRequest $request, $id)
    {
        $type = $request->type;
        if ($type == 'image') {
            if ($request->hasFile('content_data')) {
                // upload the image
                $file = $request->content_data;
                $path = $file->storeAs(
                    'app-launch-popup/images',
                    strtotime(now()).'.'.$file->getClientOriginalExtension(),
                    'public'
                );

                $data['content'] = $path;
            }
        } else {
            $data['content'] = $request->input('content_data');
        }

        $date_range_array = explode('-', $request->input('display_period'));
        $data['start_date'] = Carbon::createFromFormat('Y/m/d h:i A', trim($date_range_array[0]), 'Asia/Dhaka')
            ->setTimezone('UTC')->toDateTimeString();
        $data['end_date'] = Carbon::createFromFormat('Y/m/d h:i A', trim($date_range_array[1]), 'Asia/Dhaka')
            ->setTimezone('UTC')->toDateTimeString();

        $data['type'] = $type;
        $data['title'] = $request->title;

        $pop_up = MyBlAppLaunchPopup::find($id);

        $pop_up->update($data);

        return redirect()->back()->with('success', 'Successfully Updated');
    }


    public function destroy($id)
    {
        $pop_up = MyBlAppLaunchPopup::findOrFail($id);
        $pop_up->delete();

        return redirect()->back()->with('success', 'Successfully Deleted');
    }
}

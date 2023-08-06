<?php

namespace App\Http\Controllers\CMS;

use App\Enums\MyBlAppSettingsKey;
use App\Models\MyBlAppSettings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

/**
 * Class NajatContentsSettingsController
 * @package App\Http\Controllers\CMS
 */
class NajatContentsSettingsController extends Controller
{

    public function index()
    {
        $app_settings = MyBlAppSettings::where('key', MyBlAppSettingsKey::NAJAT_CONTENTS_SETTINGS)->first();

        $settings = json_decode($app_settings->value);

        return view('admin.najat-content-settings.index', compact('settings'));
    }

    public function store(Request $request)
    {
        $data = [
            'is_enable'             => ($request->is_enable) ? true : false,
            'show_in_home'          => ($request->show_in_home) ? true : false,
            'show_banner'           => ($request->show_banner) ? true : false,
            'show_namaj_time'       => ($request->show_namaj_time) ? true : false,
            'show_download_link'    => ($request->show_download_link) ? true : false,
            'show_iftar_sehri_time' => ($request->show_iftar_sehri_time) ? true : false,
        ];

        try {
            MyBlAppSettings::updateOrCreate(
                ['key' => MyBlAppSettingsKey::NAJAT_CONTENTS_SETTINGS],
                ['value' => json_encode($data)]
            );

            Redis::del("najat_content_settings");

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
        return redirect()->back()->with('success', 'Settings updated successfully');
    }
}

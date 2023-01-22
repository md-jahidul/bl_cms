<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Requests\UpdateConfigRequest;
use App\Models\Config;
use App\Models\User;
use App\Services\ConfigService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ConfigController extends Controller
{
    /**
     * @var $configService
     */
    private $configService;

    public function __construct(ConfigService $configService)
    {
        $this->configService = $configService;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $configs = Config::all();
        return view('admin.config.index', compact('configs'));
    }

    /**
     * @param UpdateConfigRequest $request
     * @return RedirectResponse|Redirector
     */
    public function update(UpdateConfigRequest $request)
    {
        $image_upload_size = $this->adminImageUploadSize();
        $image_upload_type = $this->adminImageUploadType();
  # Check Image upload validation
                $validator = Validator::make($request->all(), [
            'site_logo' => 'nullable|mimes:'.$image_upload_type.'|max:'.$image_upload_size, // 2M
            'login_page_banner' => 'nullable|mimes:'.$image_upload_type.'|max:'.$image_upload_size // 2M
        ]);
        if ($validator->fails()) {
            Session::flash('error', $validator->messages()->first());
            return redirect("/config");
        }

        $response = $this->configService->updateConfigData($request->all());
        Session::flash('message', $response->getContent());
        return redirect("/config");
    }


    /**
     * Get image upload size form config table for frontend customer
     * @return [number] [Image size in KB]
     */
    public static function customerImageUploadSize(){

        $config_key = Config::where('key', '=', 'image_upload_size')->first();

        if( !empty($config_key) ){
            $file_size = ((int)$config_key->value * 1024);
            return $file_size;
        }
        else{
            return (1 * 1024);
        }

    }

    /**
     * [Image upload type for frontend customer]
     * @return [mixed] [description]
     */
    public static function customerImageUploadType($type_array = false){

        $config_key = Config::where('key', '=', 'image_upload_type')->first();

        if( !empty($config_key) ){

            if( $type_array ){
                return explode(',', $config_key->value);
            }
            else{
                return $config_key->value;
            }
        }
        else{
            return 'jpeg,png';
        }

    }



    /**
     * Get image upload size form config table for cms admin user
     * @return [number] [Image size in KB]
     */
    public static function adminImageUploadSize(){

        $config_key = Config::where('key', '=', 'admin_image_upload_size')->first();

        if( !empty($config_key) ){
            $file_size = ((int)$config_key->value * 1024);
            return $file_size;
        }
        else{
            return (1 * 1024);
        }

    }

    /**
     * [Image upload type for cms admin user]
     * @return [mixed] [description]
     */
    public static function adminImageUploadType($type_array = false){

        $config_key = Config::where('key', '=', 'admin_image_upload_type')->first();

        if( !empty($config_key) ){

            if( $type_array ){
                return explode(',', $config_key->value);
            }
            else{
                return $config_key->value;
            }
        }
        else{
            return 'jpeg,png';
        }

    }

}

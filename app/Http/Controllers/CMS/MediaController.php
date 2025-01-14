<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Services\GlobalMediaService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;


class MediaController extends Controller
{
    private $settingService;

    public function __construct(GlobalMediaService $settingService)
    {
        $this->settingService = $settingService;
        $this->middleware('auth');
    }

    public function create()
    {

        $configPath = config_path('globalMediaRatio.php'); // Get the full path to the configuration file
        if (file_exists($configPath)) {
            $configContents = file_get_contents($configPath);
            $configArray = include $configPath;
            $imageSettings = $configArray['image_size'];
            // Now $configArray contains the configuration data
            // You can access specific values like $configArray['image_size']
        } else {
            $imageSettings = null;
            // Handle the case where the configuration file doesn't exist
        }
        return view('admin.global-media.create', compact('imageSettings'));

    }

    /**
     */
    public function store(Request $request)
    {
        $settingsKey = $request->input('settings_key');

        // Check if the selected setting is wildcard
        if ($settingsKey === 'wildcard') {
            $response = $this->settingService->storeMedia($request);

            if ($response['saved']) {
                return redirect(route('media.index'));
            } else {
                return redirect()->back()->with('error', 'Duplicate Setting Key');
            }
        }

        list($width, $height) = explode('x', $settingsKey);
        $image = $request->file('image');
        $imageWidth = getimagesize($image)[0];
        $imageHeight = getimagesize($image)[1];

        if ($imageWidth != $width || $imageHeight != $height) {
            return redirect()->back()->with('error', 'Image dimensions do not match the settings key');
        }

        $response = $this->settingService->storeMedia($request);

        if ($response['saved']) {
            return redirect(route('media.index'));
        } else {
            return redirect()->back()->with('error', 'Duplicate Setting Key');
        }
    }

    public function index(Request $request)
    {

        // Get the filter key from the query string
        $filterKey = $request->query('key');

        $media = $this->settingService->getFilteredData($filterKey);

        // Query the Media model and paginate the results

        return view('admin.global-media.index', compact('media'));

    }
}

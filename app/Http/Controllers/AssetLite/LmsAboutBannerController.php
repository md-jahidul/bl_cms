<?php

namespace App\Http\Controllers\AssetLite;

use App\Services\AlFaqCategoryService;
use App\Services\AlFaqService;
use App\Services\LmsAboutBannerService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class LmsAboutBannerController extends Controller
{
    /**
     * @var LmsAboutBannerService
     */
    private $lmsAboutBannerService;

    /**
     * LmsAboutBannerService constructor.
     * @param LmsAboutBannerService $lmsAboutBannerService
     */
    public function __construct(
        LmsAboutBannerService $lmsAboutBannerService
    ) {
        $this->lmsAboutBannerService = $lmsAboutBannerService;
    }

//    public function viewBannerImage()
//    {
//        $images = $this->lmsAboutBannerService->findAll();
//        $aboutLoyalty = isset($images[0]) ? $images[0] : null;
//        $aboutReward = isset($images[1]) ? $images[1] : null;
//        return view('admin.loyalty.banner-image.index', compact('aboutLoyalty', 'aboutReward'));
//    }
//
//    public function bannerUpload(Request $request)
//    {
//        $response = $this->lmsAboutBannerService->bannerImageUpload($request->all());
//        Session::flash('message', $response->getContent());
//        return redirect('lms-about-page/banner-image');
//    }
}

<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Requests\CorpCaseStudyComponentRequest;
use App\Http\Requests\StoreSliderImageRequest;
use App\Models\AboutUsBanglalink;
use App\Services\AboutUsService;
use App\Services\AlBannerService;
use App\Services\AlSliderImageService;
use App\Services\AlSliderService;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class AboutUsController extends Controller
{

    /**
     * @var $aboutUsService
     */
    private $aboutUsService;
    private $alSliderService;

    private $alSliderImageService;
    /**
     * @var AlBannerService
     */
    private $alBannerService;

    /**
     * QuickLaunchController constructor.
     * @param AboutUsService $aboutUsService
     * @param AlSliderService $alSliderService
     * @param AlSliderImageService $alSliderImageService
     */
    public function __construct(
        AboutUsService $aboutUsService,
        AlSliderService $alSliderService,
        AlSliderImageService $alSliderImageService,
        AlBannerService $alBannerService
    ) {
        $this->aboutUsService = $aboutUsService;
        $this->alSliderService = $alSliderService;
        $this->alSliderImageService = $alSliderImageService;
        $this->alBannerService = $alBannerService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $aboutUs = $this->aboutUsService->getAboutUsInfo();
        $banner = $this->alBannerService->findBanner('about_us_landing', 0);
        return view('admin.about-us.index', compact('aboutUs', 'banner'));
    }

    /**
     * @return Factory|View
     */
    public function aboutSlider()
    {
        $sliders = $this->alSliderService->shortCodeSliders('about_media');
        return view('admin.about-us.slider.index', compact('sliders'));
    }

    /**
     * @param $sliderId
     * @param $type
     * @return Factory|View
     */
    public function sliderImageList($sliderId, $type)
    {
        $slider_images = $this->alSliderImageService->itemList($sliderId, $type);
        return view('admin.about-us.slider.slider-image.index', compact('slider_images', 'sliderId', 'type'));
    }

    /**
     * @param $sliderId
     * @param $type
     * @return Factory|View
     */
    public function createSliderImage($sliderId, $type)
    {
        return view('admin.about-us.slider.slider-image.create', compact('sliderId', 'type'));
    }

    /**
     * @param Request $request
     * @param $sliderId
     * @param $type
     * @return RedirectResponse|Redirector
     */
    public function storeSliderImage(StoreSliderImageRequest $request, $sliderId, $type)
    {
        $response = $this->alSliderImageService->storeSliderImage($request->all(), $sliderId);
        Session::flash('message', $response->getContent());
        return redirect(route('about_image_list', [$sliderId, $type]));
    }

    /**
     * @param $parentId
     * @param $type
     * @param $id
     * @return Factory|View
     */
    public function editSliderImage($parentId, $type, $id)
    {
        $sliderImage = $this->alSliderImageService->findOne($id);
        $other_attributes = $sliderImage->other_attributes;
        return view('admin.about-us.slider.slider-image.edit', compact('sliderImage', 'type', 'other_attributes'));
    }

    /**
     * @param StoreSliderImageRequest $request
     * @param $parentId
     * @param $type
     * @param $id
     * @return RedirectResponse|Redirector
     */
    public function updateSliderImage(StoreSliderImageRequest $request, $parentId, $type, $id)
    {
        $response = $this->alSliderImageService->updateSliderImage($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect(route('about_image_list', [$parentId, $type]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.about-us.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $request->validate([
            'url_slug' => 'required|unique:about_us_banglalink,url_slug',
            'url_slug_bn' => 'required|unique:about_us_banglalink,url_slug_bn'
        ]);
        $response = $this->aboutUsService->storeAboutUsInfo($request);
        Session::flash('message', $response->getContent());
        return redirect('about-us');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param AboutUsBanglalink $aboutUs
     * @return Factory|View
     */
    public function edit($id)
    {
        $about = $this->aboutUsService->findOne($id);
        $other_attributes = $about->other_attributes;
        return view('admin.about-us.create',compact('about','other_attributes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param AboutUsBanglalink $aboutUs
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $aboutUs = $this->aboutUsService->findOne($id);
        $request->validate([
            'url_slug' => 'required|unique:about_us_banglalink,url_slug,' . $aboutUs->id,
            'url_slug_bn' => 'required|unique:about_us_banglalink,url_slug_bn,' . $aboutUs->id
        ]);
        $response = $this->aboutUsService->updateAboutUsInfo($request, $aboutUs);

        if ($response) {
             session()->flash('success', "Updated successfully");
             return redirect(route('about-us.index'));
        }
        session()->flash('message', "Failed! Please try again");
    }

    /**
     * @param $id
     * @return UrlGenerator|string
     * @throws \Exception
     */
    public function destroy($id)
    {
        $response = $this->aboutUsService->deleteAboutUsInfo($id);
        if ($response) {
            session()->flash('error', "Deleted successfully");
            return redirect(route('about-us.index'));
        }

        session()->flash('message', "Failed! Please try again");
    }

    /**
     * @param $parentId
     * @param $type
     * @param $id
     * @return UrlGenerator|string
     * @throws \Exception
     */
    public function destroySliderImage($parentId, $type, $id)
    {
        $response = $this->alSliderImageService->deleteSliderImage($id);
        Session::flash('message', $response->getContent());
        return url(route('about_image_list', [$parentId, $type]));
    }

}

<?php

namespace App\Http\Controllers\AssetLite;

use App\Models\AboutUsBanglalink;
use App\Services\AboutUsService;
use App\Services\AlSliderService;
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

    /**
     * QuickLaunchController constructor.
     * @param AboutUsService $aboutUsService
     * @param AlSliderService $alSliderService
     */
    public function __construct(AboutUsService $aboutUsService, AlSliderService $alSliderService)
    {
        $this->aboutUsService = $aboutUsService;
        $this->alSliderService = $alSliderService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $aboutUs = $this->aboutUsService->getAboutUsInfo();
        return view('admin.about-us.index', compact('aboutUs'));
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
     * Show the form for creating a new resource.
     *
     * @return Response
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
        $response = $this->aboutUsService->storeAboutUsInfo($request);
        Session::flash('message', $response->getContent());
        return redirect('about-us');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param AboutUsBanglalink $aboutUs
     * @return Response
     */
    public function edit(AboutUsBanglalink $aboutUs)
    {
        return view('admin.about-us.create')->with('about', $aboutUs);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param AboutUsBanglalink $aboutUs
     * @return Response
     */
    public function update(Request $request, AboutUsBanglalink $aboutUs)
    {
        $response = $this->aboutUsService->updateAboutUsInfo($request, $aboutUs);

        if ($response) {
             session()->flash('success', "Updated successfully");
             return redirect(route('about-us.index'));
        }

        session()->flash('message', "Failed! Please try again");
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
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

}

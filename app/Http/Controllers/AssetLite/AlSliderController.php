<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Requests\StoreSliderRequest;
use App\Services\AlSliderService;
use App\Services\AlSliderComponentTypeService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class AlSliderController extends Controller
{
    /**
     * @var AlSliderService
     */
    private $alSliderService;
    /**
     * @var bool
     */
    private $isAuthenticated = true;

    /**
     * @var AlSliderComponentTypeService
     */
    private $sliderTypeComponentService;

    /**
     * AlSliderController constructor.
     * @param AlSliderService $alSliderService
     * @param AlSliderComponentTypeService $alSliderComponentTypeService
     */
    public function __construct(AlSliderService $alSliderService, AlSliderComponentTypeService $alSliderComponentTypeService)
    {
        $this->alSliderService = $alSliderService;
        $this->sliderTypeComponentService = $alSliderComponentTypeService;
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function singleSlider()
    {
        $sliders = $this->alSliderService->allSingleSlider();
        return view('admin.slider.index', compact('sliders'));
    }

    public function multiSlider()
    {
        $sliders = $this->alSliderService->allMultiSlider();
        return view('admin.slider.multi-slider', compact('sliders'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $sliderTypes = $this->sliderTypeComponentService->findAll();
        return view('admin.slider.create', compact('sliderTypes'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */

    public function store(StoreSliderRequest $request)
    {
        $response = $this->alSliderService->storeSlider($request->all());
        Session::flash('message', $response->getContent());
        return redirect('/sliders');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id, $type)
    {
        $slider = $this->alSliderService->findOne($id);
        $other_attributes = $slider->other_attributes;
        return view('admin.slider.edit', compact('slider', 'type', 'other_attributes'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $sliderType = $request->slider_type;
        $response = $this->alSliderService->updateSlider($request->all(), $request->id);
        Session::flash('message', $response->getContent());
        return redirect("/$sliderType-sliders");
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy($id)
    {
        $response = $this->alSliderService->deleteSlider($id);
        Session::flash('message', $response->getContent());
        return redirect('/sliders');
    }

}

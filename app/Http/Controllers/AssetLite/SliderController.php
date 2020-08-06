<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Requests\StoreSliderRequest;
use App\Services\AlSliderService;
use App\Services\AlSliderComponentTypeService;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class SliderController extends Controller
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
     * @return Factory|View
     */

    /**
     * @return Factory|View
     */
    public function singleSlider()
    {
        $sliders = $this->alSliderService->sliders('single');
//        return $sliders;
        return view('admin.slider.index', compact('sliders'));
    }

    /**
     * @return Factory|View
     */
    public function multiSlider()
    {
        $sliders = $this->alSliderService->sliders('multiple');
        return view('admin.slider.multi-slider', compact('sliders'));
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        $sliderTypes = $this->sliderTypeComponentService->findAll();
        return view('admin.slider.create', compact('sliderTypes'));
    }

    /**
     * @param StoreSliderRequest $request
     * @return RedirectResponse|Redirector
     */

    public function store(StoreSliderRequest $request)
    {
        $response = $this->alSliderService->storeSlider($request->all());
        Session::flash('message', $response->getContent());
        return redirect('/sliders');
    }

    /**
     * @param $id
     * @return Factory|View
     */
    public function edit($id, $type)
    {
        $slider = $this->alSliderService->findOne($id);
        $previousUrl = url()->previous();
        $other_attributes = $slider->other_attributes;
        return view('admin.slider.edit', compact('slider', 'type', 'other_attributes', 'previousUrl'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, $id)
    {
        $sliderType = $request->slider_type;
        $response = $this->alSliderService->updateSlider($request->all(), $request->id);
        Session::flash('message', $response->getContent());
        return redirect((strpos($request->previous_url, 'about-slider') !== false) ? $request->previous_url : url("/$sliderType-sliders"));
    }

    /**
     * @param $id
     * @return RedirectResponse|Redirector
     * @throws Exception
     */
    public function destroy($id)
    {
        $response = $this->alSliderService->deleteSlider($id);
        Session::flash('message', $response->getContent());
        return redirect('/sliders');
    }
}

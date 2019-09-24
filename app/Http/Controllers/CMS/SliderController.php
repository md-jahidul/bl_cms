<?php

namespace App\Http\Controllers\CMS;

use App\Http\Requests\StoreSliderRequest;
use App\Services\SliderService;
use App\Services\SliderTypeService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class SliderController extends Controller
{
    /**
     * @var SliderService
     */
    private $sliderService;
    /**
     * @var bool
     */
    private $isAuthenticated = true;

    /**
     * @var SliderTypeService
     */
    private $sliderTypeService;

    /**
     * SliderController constructor.
     * @param SliderService $sliderService
     * @param SliderTypeService $sliderTypeService
     */
    public function __construct(SliderService $sliderService, SliderTypeService $sliderTypeService)
    {
        $this->sliderService = $sliderService;
        $this->sliderTypeService = $sliderTypeService;
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index()
    {
        $sliders = $this->sliderService->findAll();

//        return $sliders;

        return view('admin.slider.index', compact('sliders'));

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $sliderTypes = $this->sliderTypeService->findAll();
        return view('admin.slider.create', compact('sliderTypes'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */

    public function store(StoreSliderRequest $request)
    {
        $response = $this->sliderService->storeSlider($request->all());
        Session::flash('message', $response->getContent());
        return redirect('/sliders');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id, $type)
    {


        $slider = $this->sliderService->findOne($id);
//        $sliderTypes = $this->sliderTypeService->findAll();
        return view('admin.slider.edit', compact('slider', 'type'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $response = $this->sliderService->updateSlider($request->all(), $request->id);
        Session::flash('message', $response->getContent());
        return redirect('/sliders');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy($id)
    {
        $response = $this->sliderService->deleteSlider($id);
        Session::flash('message', $response->getContent());
        return redirect('/sliders');
    }

}

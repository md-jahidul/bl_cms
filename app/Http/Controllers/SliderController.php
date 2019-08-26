<?php

namespace App\Http\Controllers;

use App\Services\SliderService;
use App\Services\SliderTypeService;
use App\SliderType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class SliderController extends Controller
{
    /*
     * @var SliderService
     */
    private $sliderService;
    private $isAuthenticated = true;
    private $sliderTypeService;

    /**
     * Create a new service instance.
     * @param SliderService $sliderService
     */
    public function __construct(SliderService $sliderService, SliderTypeService $sliderTypeService)
    {
        $this->sliderService = $sliderService;
        $this->sliderTypeService = $sliderTypeService;
    }

    /**
     * Display the list of digitalService
     * @return Response
     */

    public function index()
    {
        $sliders = $this->sliderService->findAll();
        return view('admin.slider.index', compact('sliders'));

    }

    /**
     * Display the slider create form
     */
    public function create()
    {
        $sliderTypes = $this->sliderTypeService->findAll();
        return view('admin.slider.create', compact('sliderTypes'));

    }

    /**
     * Store the slider
     * @return Response
     */

    //TODO::Back-end validation required
    public function store(Request $request)
    {
        $response = $this->sliderService->storeSlider($request->all());

        Session::flash('message', $response);
        return redirect('/sliders');
    }

    /*
     * Editing the slider
     * @param $id
     * @return Response
     */
    public function edit($id)
    {
        $slider = $this->sliderService->findOne($id);
        $sliderTypes = $this->sliderTypeService->findAll();
        return view('admin.slider.edit', compact('slider', 'sliderTypes'));

    }

    public function update(Request $request, $id)
    {
        $slider = $this->sliderService->findOne($id);
        $response = $slider->update($request->all());
        return redirect('/sliders');
    }

    /**
     * Display the list of digitalService
     * @return Response
     */
    public function get()
    {
        $data = [
            'test' => 'sdaf'
        ];

        // $data = $this->digitalService->findAll();

        $response = new \stdClass();
        if ($this->isAuthenticated) {
            $response->response_code = 200;
            $response->errors = null;
            $response->data = $data;
        } else {
            $response->response_code = 401;
            $response->errors = array("Invalid Token");
            $response->data = $this->isAuthenticated();
        }
        return Response()->json($response);
    }
}

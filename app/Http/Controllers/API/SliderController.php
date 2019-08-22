<?php

namespace App\Http\Controllers\API;

use App\Services\SliderService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class SliderController extends Controller
{
    /*
     * @var $digitalService;
     */
    private $sliderService;

    private $isAuthenticated = true;


    /**
     * Create a new service instance.
     * @param SliderService $sliderService
     */
    public function __construct(SliderService $sliderService)
    {
        $this->sliderService = $sliderService;
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

<?php

namespace App\Http\Controllers\API;

use App\Services\DigitalServicesService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class DigitalServiceController extends Controller
{
    /*
     * @var $digitalService;
     */
    private $digitalService;


    /**
     * Create a new service instance.
     * @param DigitalServicesService $digitalServicesService
     */
    public function __construct(DigitalServicesService $digitalServicesService)
    {
        $this->digitalService = $digitalServicesService;
    }


    /**
     * Display the list of digitalService
     * @return Response
     */
    public function getDigitalServices()
    {
        return Response()->json($this->digitalService->findAll());
    }


//    public function testApi()
//    {
//
//    }
}

<?php

namespace App\Http\Controllers;

use App\Services\FirebaseService;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;

class FireBaseController extends Controller
{

    /**
     * @var FirebaseService
     */
    private $firebaseService;

    public function __construct(FirebaseService $firebaseService)
    {
        $this->firebaseService= $firebaseService;
    }

    public function getData()
    {
        return $this->firebaseService->testData();
    }
}

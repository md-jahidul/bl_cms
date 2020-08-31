<?php

namespace App\Http\Controllers\AssetLite;

use App\Services\UniversityService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\View\View;

class UniversityController extends Controller
{
    /**
     * @var UniversityService
     */
    private $universityService;

    /**
     * UniversityController constructor.
     * @param UniversityService $universityService
     */
    public function __construct(UniversityService $universityService)
    {
        $this->universityService = $universityService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        $universities = $this->universityService->findAll();
        return view('admin.university.index', compact('universities'));
    }

    public function universityList(Request $request)
    {
        return $this->universityService->getUniversities($request);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function uploadUniversityExcel(Request $request)
    {
        return $this->universityService->saveExcel($request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function deleteUniversity($universityId = 0)
    {
        return $this->universityService->deleteUniversity($universityId);
    }
}

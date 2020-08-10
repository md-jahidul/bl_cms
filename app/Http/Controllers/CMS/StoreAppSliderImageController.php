<?php

namespace App\Http\Controllers\CMS;

use App\Services\StoreAppService;
use App\Services\StoreAppSliderImageService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SliderImageStoreRequest;
use App\Services\MyblSliderService;
use App\Services\AlSliderComponentTypeService;
use App\Models\SliderImage;
use Illuminate\Http\Response;
use Illuminate\View\View;

class StoreAppSliderImageController extends Controller
{

    private $sliderImageService;
    private $storeAppService;
    private $sliderTypeService;


    /**
     * StoreAppSliderImageController constructor.
     * @param StoreAppSliderImageService $sliderImageService
     * @param StoreAppService $storeAppService
     * @param AlSliderComponentTypeService $sliderTypeService
     */
    public function __construct(
        StoreAppSliderImageService $sliderImageService,
        StoreAppService $storeAppService,
        AlSliderComponentTypeService $sliderTypeService
    ) {
        $this->sliderImageService = $sliderImageService;
        $this->storeAppService = $storeAppService;
        $this->sliderTypeService = $sliderTypeService;
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @param $sliderId
     * @return Factory|View
     */
    public function index($sliderId)
    {
        $slider_information = $this->storeAppService->findOne($sliderId);

        return view('admin.store.images.index', compact('sliderId', 'slider_information'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @param $sliderId
     * @return Factory|View
     */
    public function create($sliderId)
    {
        $slider_information = $this->storeAppService->findOne($sliderId);
        return view('admin.store.images.create', compact('sliderId', 'slider_information'));
    }

    /**return redirect(route('store.index'));
     * Store a newly created resource in storage.
     *
     * @param SliderImageStoreRequest $request
     * @return RedirectResponse
     */
    public function store(SliderImageStoreRequest $request)
    {
        $response = $this->sliderImageService->storeSliderImage($request->all());
        session()->flash('message', $response->getContent());
        return redirect()->back();
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return Response
     */
    public function updatePosition(Request $request)
    {
        foreach ($request->position as $position) {
            $image = SliderImage::FindorFail($position[0]);
            $image->update(['sequence' => $position[1]]);
        }
        return "success";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $sliderImageId
     * @return Response
     */
    public function edit($sliderImageId)
    {
        $imageInfo = SliderImage::find($sliderImageId);
        return view('admin.store.images.edit', compact('imageInfo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SliderImageUpdateRequest $request
     * @param int $id
     * @return Response
     */
    public function update(SliderImageUpdateRequest $request, $id)
    {
        $response = $this->sliderImageService->updateSliderImage($request->all(), $id);
        session()->flash('success', $response->getContent());
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        session()->flash('error', $this->sliderImageService->deletesliderImage($id)->getContent());
        return redirect()->back();
    }
}

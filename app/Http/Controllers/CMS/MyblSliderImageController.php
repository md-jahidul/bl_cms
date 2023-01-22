<?php

namespace App\Http\Controllers\CMS;

use App\Services\BaseMsisdnService;
use App\Services\FeedCategoryService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\MyblSliderImageService;
use App\Http\Requests\SliderImageStoreRequest;
use App\Http\Requests\SliderImageUpdateRequest;
use App\Services\MyblSliderService;
use App\Services\AlSliderComponentTypeService;
use App\Models\SliderImage;
use Illuminate\Http\Response;
use Illuminate\View\View;

class MyblSliderImageController extends Controller
{

    private $sliderImageService;
    private $sliderService;
    private $sliderTypeService;
    private $baseMsisdnService;
    private $feedCategoryService;

    /**
     * BannerController constructor.
     * @param MyblSliderImageService $sliderImageService
     * @param MyblSliderService $sliderService
     * @param AlSliderComponentTypeService $sliderTypeService
     * @param BaseMsisdnService $baseMsisdnService
     */
    public function __construct(
        MyblSliderImageService $sliderImageService,
        MyblSliderService $sliderService,
        AlSliderComponentTypeService $sliderTypeService,
        BaseMsisdnService $baseMsisdnService,
        FeedCategoryService $feedCategoryService
    ) {
        $this->sliderImageService = $sliderImageService;
        $this->sliderService = $sliderService;
        $this->sliderTypeService = $sliderTypeService;
        $this->baseMsisdnService = $baseMsisdnService;
        $this->feedCategoryService = $feedCategoryService;
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
        $slider = $this->sliderService->findOne($sliderId);
        $sliderImages = $this->sliderImageService->itemList($sliderId);
        return view(
            'admin.myblslider.images.index',
            compact('sliderId', 'slider', 'sliderImages')
        );
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create($sliderId)
    {
        $baseGroups = $this->baseMsisdnService->findAll();
        $slider_information = $this->sliderService->findOne($sliderId);
        return view('admin.myblslider.images.create', compact('sliderId', 'slider_information','baseGroups'));
    }

    /**return redirect(route('myblslider.index'));
     * Store a newly created resource in storage.
     *
     * @param SliderImageStoreRequest $request
     * @return RedirectResponse
     */
    public function store(SliderImageStoreRequest $request)
    {
        session()->flash('message', $this->sliderImageService->storeSliderImage($request->all())->getContent());
        return redirect()->back();
    }

    public function getMyblProducts()
    {
        return $this->sliderImageService->getActiveProducts();
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
        //return $request;
        foreach ($request->position as $position) {
            $image = SliderImage::FindorFail($position[0]);
            $image->update(['sequence' => $position[1]]);
        }
        return "success";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Factory|\Illuminate\Contracts\Foundation\Application|View
     */
    public function edit($sliderImageId)
    {
        $imageInfo = $this->sliderImageService->findOne($sliderImageId, 'baseImageCats');
        $products  = $this->sliderImageService->getActiveProducts();
        $baseGroups = $this->baseMsisdnService->findAll();
        $feedCategories = $this->feedCategoryService->findAll();
        return view('admin.myblslider.images.edit', compact('imageInfo', 'products', 'baseGroups', 'feedCategories'));
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
        if ($response->status() == 500) {
            session()->flash('error', $response->getContent());
        } else {
            session()->flash('success', $response->getContent());
        }
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

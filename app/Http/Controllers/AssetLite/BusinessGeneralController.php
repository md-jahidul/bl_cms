<?php

namespace App\Http\Controllers\AssetLite;

use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\BusinessHomeService;
use App\Http\Requests\BusinessNewsRequest;
use App\Http\Requests\BusinessFeaturesRequest;
use App\Http\Requests\BusinessProductCategoriesRequest;

class BusinessGeneralController extends Controller {

    private $businessHomeService;

    /**
     * BusinessGeneralController constructor.
     * @param BusinessHomeService $businessHomeService
     */
    public function __construct(BusinessHomeService $businessHomeService) {
        $this->businessHomeService = $businessHomeService;
    }

    /**
     * Display Categories, Banner, News and Features of Business.
     *
     * @param No
     * @return Factory|View
     * @Bulbul Mahmud Nito || 11/02/2020
     */
    public function index() {
        $categories = $this->businessHomeService->getCategories();
        $banners = $this->businessHomeService->getHomeBanners();
        $slidingSpeed = $this->businessHomeService->slidingSpeed();
        $news = $this->businessHomeService->getNews();
        $features = $this->businessHomeService->getFeatures();
        return view('admin.business.index', compact('categories', 'banners', 'slidingSpeed', 'news', 'features'));
    }

    /**
     * Home Banner Photo save
     *
     * @param Request $request
     * @return JsonResponse
     * @Dev Bulbul Mahmud Nito || 11/02/2020
     */
    public function bannerPhotoSave(Request $request) {
        $bannersSave = $this->businessHomeService->saveHomeBanners($request);
        return $bannersSave;
    }

    /**
     * Category data by id
     *
     * @param $catId
     * @return JsonResponse
     * @Dev Bulbul Mahmud Nito || 06/04/2020
     */
    public function getCategory($catId) {
        $nameChange = $this->businessHomeService->getCategoryById($catId);
        return $nameChange;
    }

    /**
     * Category data update.
     *
     * @param Request $request
     * @return JsonResponse
     * @Dev Bulbul Mahmud Nito || 06/04/2020
     */
    public function updateCategory(BusinessProductCategoriesRequest $request) {
        $response = $this->businessHomeService->updateCategory($request);
        if ($response['success'] == 1) {
            Session::flash('message', 'Category updated successfully!');
        } else if ($response['success'] == 2) {
            Session::flash('error', "The banner name is not unique!");
        } else {
            Session::flash('error', $response['message']);
        }
        return redirect('business-general');
    }

    /**
     * Category name Change.
     *
     * @param Request $request
     * @return JsonResponse
     * @Dev Bulbul Mahmud Nito || 12/02/2020
     */
    public function categoryNameChange(Request $request) {
        return $this->businessHomeService->changeCategoryName($request);
    }

    /**
     * Category banner photo save
     *
     * @param Request $request
     * @return JsonResponse
     * @Dev Bulbul Mahmud Nito || 15/03/2020
     */
    public function categoryBannerSave(Request $request) {
        $bannersSave = $this->businessHomeService->saveCatBanners($request);
        return $bannersSave;
    }

    /**
     * Category Sorting Change.
     *
     * @param Request $request
     * @return JsonResponse
     * @Dev Bulbul Mahmud Nito || 12/02/2020
     */
    public function categorySortChange(Request $request) {
        $sortChange = $this->businessHomeService->changeCategorySort($request);
        return $sortChange;
    }

    /**
     * Category home show status Change.
     *
     * @param Request $request
     * @return JsonResponse
     * @Dev Bulbul Mahmud Nito || 12/02/2020
     */
    public function categoryStatusChange(Request $request) {

        $catId = $request->catId;
        $response = $this->businessHomeService->categoryStatusChange($catId);
        return $response;
    }

    /**
     * Save/update sliding speed
     *
     * @param Request $request
     * @return JsonResponse
     * @Dev Bulbul Mahmud Nito || 05/03/2020
     */
    public function saveSlidingSpeed(Request $request) {
        $bannersSave = $this->businessHomeService->saveSlidingSpeed($request);
        return $bannersSave;
    }

    /**
     * Save or Update home news
     *
     * @param Request $request
     * @return JsonResponse
     * @Dev Bulbul Mahmud Nito || 12/02/2020
     */
    public function homeNewsSave(BusinessNewsRequest $request) 
    {
        $response = $this->businessHomeService->saveNews($request);

        if ($response['success'] == 1) {
            Session::flash('sussess', 'News is saved!');
        } else {
            Session::flash('error', 'News saving process failed!');
        }

        return redirect('/business-general');
    }

    /**
     * Get news by ID
     *
     * @param News ID $newsId
     * @return JsonResponse
     * @Dev Bulbul Mahmud Nito || 12/02/2020
     */
    public function getNewsById($newsId) {

        $response = $this->businessHomeService->getNewsById($newsId);
        return $response;
    }

    /**
     * News Sorting Change.
     *
     * @param Request $request
     * @return JsonResponse
     * @Dev Bulbul Mahmud Nito || 24/02/2020
     */
    public function newsSortChange(Request $request) {
        $sortChange = $this->businessHomeService->changeNewsSort($request);
        return $sortChange;
    }

    /**
     * News status Change.
     *
     * @param $newsId
     * @return JsonResponse
     * @Dev Bulbul Mahmud Nito || 12/02/2020
     */
    public function newsStatusChange($newsId) {

        $response = $this->businessHomeService->newsStatusChange($newsId);
        return $response;
    }

    /**
     * News delete.
     *
     * @param $newsId
     * @return JsonResponse
     * @Dev Bulbul Mahmud Nito || 12/02/2020
     */
    public function newsDelete($newsId) {

        $response = $this->businessHomeService->deleteNews($newsId);
        if ($response['success'] == 1) {
            Session::flash('sussess', 'News is deleted!');
        } else {
            Session::flash('error', 'News deleting process failed!');
        }

        return redirect('/business-general');
    }

    /**
     * Features Sorting Change.
     *
     * @param Request $request
     * @return JsonResponse
     * @Dev Bulbul Mahmud Nito || 13/02/2020
     */
    public function featureSortChange(Request $request) {
        $sortChange = $this->businessHomeService->changeFeatureSort($request);
        return $sortChange;
    }

    /**
     * Features status Change.
     *
     * @param $featureId
     * @return JsonResponse
     * @Dev Bulbul Mahmud Nito || 13/02/2020
     */
    public function featureStatusChange($featureId) {

        $response = $this->businessHomeService->featureStatusChange($featureId);
        return $response;
    }

    /**
     * Save or Update business feature
     *
     * @param Request $request
     * @return JsonResponse
     * @Dev Bulbul Mahmud Nito || 13/02/2020
     */
    public function featureSave(BusinessFeaturesRequest $request) {

        $response = $this->businessHomeService->saveFeature($request);

        if ($response['success'] == 1) {
            Session::flash('sussess', 'Feature is saved!');
        } else {
            Session::flash('error', 'Feature saving process failed!');
        }

        return redirect('/business-general');
    }

    /**
     * Get feature by ID
     *
     * @param News ID $featureId
     * @return JsonResponse
     * @Dev Bulbul Mahmud Nito || 13/02/2020
     */
    public function getFeatureById($featureId) {

        $response = $this->businessHomeService->getFeaturesById($featureId);
        return $response;
    }

    /**
     * Feature delete.
     *
     * @param $featureId
     * @return JsonResponse
     * @Dev Bulbul Mahmud Nito || 13/02/2020
     */
    public function featureDelete($featureId) {

        $response = $this->businessHomeService->deleteFeature($featureId);
        if ($response['success'] == 1) {
            Session::flash('sussess', 'News is deleted!');
        } else {
            Session::flash('error', 'News deleting process failed!');
        }

        return redirect('/business-general');
    }

}

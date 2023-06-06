<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoamingCategoriesRequest;
use App\Services\RoamingGeneralService;
use Illuminate\Http\Request;
use Session;

class RoamingGeneralController extends Controller {

    private $generalService;

    /**
     * RoamingGeneralController constructor.
     * @param RoamingGeneralService $generalService
     */
    public function __construct(RoamingGeneralService $generalService) {
        $this->generalService = $generalService;
    }

    /**
     * Display Categories, about page, bill payment page
     *
     * @param No
     * @return Factory|View
     * @Bulbul Mahmud Nito || 20/03/2020
     */
    public function index() {
        $categories = $this->generalService->getCategories();
        $pages = $this->generalService->getPages();

        return view('admin.roaming.index', compact('categories', 'pages'));
    }

    /**
     * Get category by ID
     *
     * @param cat ID $catId
     * @return JsonResponse
     * @Dev Bulbul Mahmud Nito || 20/03/2020
     */
    public function getSingleCategory($catId) {

        $response = $this->generalService->getCategoryById($catId);
        return $response;
    }

    /**
     * Update category
     *
     * @param Request $request
     * @return JsonResponse
     * @Dev Bulbul Mahmud Nito || 20/03/2020
     */
    public function updateCategory(RoamingCategoriesRequest $request) {

        $response = $this->generalService->updateCategory($request);

        if ($response['success'] == 1) {
            Session::flash('sussess', 'Category is updated!');
        } else {
            Session::flash('error', 'Category updating process failed!');
        }

        return redirect('/roaming-general');
    }

    /**
     * Category Sorting Change.
     *
     * @param Request $request
     * @return JsonResponse
     * @Dev Bulbul Mahmud Nito || 22/03/2020
     */
    public function categorySortChange(Request $request) {
        $sortChange = $this->generalService->changeCategorySort($request);
        return $sortChange;
    }

    /**
     * Edit form for general page
     *
     * @param $type, $pageId
     * @return Factory|View
     * @Bulbul Mahmud Nito || 20/03/2020
     */
    public function editPage($type, $pageId) {
        $page = $this->generalService->getPageById($pageId);
        $components = $this->generalService->getPageComponents($pageId);

        return view('admin.roaming.general_page_components', compact('type', 'page', 'components'));
    }

    /**
     * Update general page
     *
     * @param Request $request
     * @return Factory|View
     * @Bulbul Mahmud Nito || 23/03/2020
     */
    public function updatePage(Request $request) {
        $response = $this->generalService->updatePage($request);
        if ($response['success'] == 1) {
            Session::flash('sussess', 'Page update successfully!!');
        } else {
            Session::flash('error', $response['message']);
        }
        return redirect('roaming/general-page-component/page/' . $request->page_id);
    }

    /**
     * Component delete.
     *
     * @param $pageId, $comId
     * @return JsonResponse
     * @Dev Bulbul Mahmud Nito || 25/03/2020
     */
    public function componentDelete($pageId, $comId) {
        $response = $this->generalService->deleteComponent($comId);
        if ($response['success'] == 1) {
            Session::flash('sussess', 'Component is deleted!');
        } else {
            Session::flash('error', 'Component deleting process failed!');
        }

        return redirect('roaming/general-page-component/page/'.$pageId);
    }

    /**
     * Component Sorting Change.
     *
     * @param Request $request
     * @return JsonResponse
     * @Dev Bulbul Mahmud Nito || 24/03/2020
     */
    public function componentSortChange(Request $request) {
        $sortChange = $this->generalService->changeComponentSort($request);
        return $sortChange;
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
     * Category name Change.
     *
     * @param Request $request
     * @return JsonResponse
     * @Dev Bulbul Mahmud Nito || 12/02/2020
     */
    public function categoryNameChange(Request $request) {
        $nameChange = $this->businessHomeService->changeCategoryName($request);
        return $nameChange;
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
    public function homeNewsSave(Request $request) {

        $response = $this->businessHomeService->saveNews($request);

        if ($response['success'] == 1) {
            Session::flash('sussess', 'News is saved!');
        } else {
            Session::flash('error', 'News saving process failed!');
        }

        return redirect('/business-general');
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
    public function featureSave(Request $request) {

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

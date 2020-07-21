<?php
namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Services\StoreAppService;
use App\Services\StoreCategoryService;
use App\Services\StoreService;
use App\Services\StoreSubCategoryService;
use Illuminate\Http\Request;

/**
 * Class StoreAppController
 * @package App\Http\Controllers\CMS
 */
class StoreAppController extends Controller
{
    /**
     * @var StoreService
     */
    protected $storeAppService;

    /**
     * @var StoreCategoryService
     */
    protected $storeCategoryService;

    /**
     * @var StoreSubCategoryService
     */
    private $storeSubCategoryService;


    /**
     * StoreController constructor.
     * @param StoreAppService $storeAppService
     * @param StoreCategoryService $storeCategoryService
     * @param StoreSubCategoryService $storeSubCategoryService
     */
    public function __construct(
        StoreAppService $storeAppService,
        StoreCategoryService $storeCategoryService,
        StoreSubCategoryService $storeSubCategoryService
    ) {
        $this->storeAppService = $storeAppService;
        $this->storeCategoryService = $storeCategoryService;
        $this->storeSubCategoryService = $storeSubCategoryService;
        $this->middleware('auth');
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apps = $this->storeAppService->findAll();
        $category =  $this->storeCategoryService->findAll();
        return view('admin.store.app.index')
            ->with('category', $category)
            ->with('apps', $apps);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $apps = $this->storeAppService->findAll();
        $categories =  $this->storeCategoryService->findAll();
        $subCategories =  $this->storeSubCategoryService->findAll();

        return view('admin.store.app.create')
            ->with('apps', $apps)
            ->with('categories', $categories)
            ->with('subCategories', $subCategories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $content = $this->storeAppService->storeMyBlStore($request->all())->getContent();
        session()->flash('message', $content);
        return redirect(route('appStore.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $app = $this->storeAppService->findOne($id, 'StoreCategory');

        return view('admin.store.app.index')
            ->with('app', $app);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $app = $this->storeAppService->findOne($id);
        $categories = $this->storeCategoryService->findAll();
        $subCategories =  $this->storeSubCategoryService->findAll();
        return view('admin.store.app.create')
            ->with('app', $app)
            ->with('categories', $categories)
            ->with('subCategories', $subCategories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param NotificationRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $content = $this->storeAppService->updateStore($request->all(), $id)->getContent();
        session()->flash('success', $content);
        return redirect(route('appStore.index'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     * @throws \Exception
     */
    public function destroy($id)
    {
        $response = $this->storeAppService->deleteStore($id);
        session()->flash('error', $response->getContent());
        return url('appStore');
    }

}

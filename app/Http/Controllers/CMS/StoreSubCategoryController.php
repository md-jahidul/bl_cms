<?php
namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Services\StoreCategoryService;
use App\Services\StoreSubCategoryService;
use Illuminate\Http\Request;

class StoreSubCategoryController extends Controller
{

    /**
     * @var StoreCategoryService
     */
    protected $storeCategoryService;

    /**
     * @var StoreSubCategoryService
     */
    private $storeSubCategoryService;


    /**
     * StoreSubCategoryController constructor.
     * @param StoreCategoryService $storeCategoryService
     * @param StoreSubCategoryService $storeSubCategoryService
     */
    public function __construct(
        StoreCategoryService $storeCategoryService,
        StoreSubCategoryService $storeSubCategoryService
)
    {
        $this->storeCategoryService = $storeCategoryService;
        $this->storeSubCategoryService = $storeSubCategoryService;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $storeSubCategories = $this->storeSubCategoryService->findAll();
        return view('admin.store.sub-category.index')->with('storeSubCategories', $storeSubCategories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categories =  $this->storeCategoryService->findAll();

        return view('admin.store.sub-category.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $response = $this->storeSubCategoryService->storeStoreSubCategory($request->all());
        session()->flash('message', $response->getContent());
        return redirect(route('subStore.index'));
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
        $categories =  $this->storeCategoryService->findAll();
        $storeSubCategories = $this->storeSubCategoryService->findOne($id);

        return view('admin.store.sub-category.create')
            ->with('categories', $categories)
            ->with('storeSubCategories', $storeSubCategories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $response = $this->storeSubCategoryService->updateStoreSubCategory($request->all(), $id);
        session()->flash('success', $response->getContent());
        return redirect(route('subStore.index'));
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
        $response = $this->storeSubCategoryService->deleteStoreSubCategory($id);
        session()->flash('error', $response->getContent());
        return url('subStore');
    }
}

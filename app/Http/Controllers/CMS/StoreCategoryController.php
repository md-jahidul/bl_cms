<?php
namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Services\StoreCategoryService;
use Illuminate\Http\Request;

class StoreCategoryController extends Controller
{
    /**
     * @var StoreCategoryService
     */
    private $storeCategoryService;


    /**
     * StoreCategoryController constructor.
     * @param StoreCategoryService $storeCategoryService
     */
    public function __construct(StoreCategoryService $storeCategoryService)
    {
        $this->storeCategoryService = $storeCategoryService;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $storeCategories = $this->storeCategoryService->findAll();
        return view('admin.store.category.index')->with('storeCategories', $storeCategories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.store.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $response = $this->storeCategoryService->storeStoreCategory($request->all());
        session()->flash('message', $response->getContent());
        return redirect(route('storeCategory.index'));
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
       // $storeCategories = $this->storeCategoryService->findAll();
        $storeCategory = $this->storeCategoryService->findOne($id);

        return view('admin.store.category.create')
            ->with('storeCategory', $storeCategory);
            //->with('storeCategories', $storeCategories);
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
        $response = $this->storeCategoryService->updateStoreCategory($request->all(), $id);
        session()->flash('success', $response->getContent());
        return redirect(route('storeCategory.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $response = $this->storeCategoryService->deleteStoreCategory($id);
        session()->flash('error', $response->getContent());
        return url('storeCategory');
    }
}

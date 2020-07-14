<?php
namespace App\Http\Controllers;

use App\Services\StoreSubCategoryService;
use Illuminate\Http\Request;

class StoreSubCategoryController extends Controller
{
    /**
     * @var NotificationCategoryService
     */
    private $storeSubCategoryService;


    /**
     * StoreSubCategoryController constructor.
     * @param StoreSubCategoryService $storeSubCategoryService
     */
    public function __construct(StoreSubCategoryService $storeSubCategoryService)
    {
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
        return view('admin.store.category.index')->with('storeSubCategories', $storeSubCategories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.store.sub-category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        session()->flash('message', $this->storeSubCategoryService->storeSubCategory($request->all())->getContent());
        return redirect(route('storeSubCategory.index'));
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
        $storeSubCategories = $this->storeSubCategoryService->findAll();
        $notificationCategory = $this->storeSubCategoryService->findOne($id);

        return view('admin.store.sub-category.create')
            ->with('notificationCategory', $notificationCategory)
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
        session()->flash('success', $this->storeSubCategoryService->updateSubCategory($request->all(), $id)->getContent());
        return redirect(route('storeSubCategory.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        session()->flash('error', $this->storeSubCategoryService->deleteSubCategory($id)->getContent());
        return url('storeSubCategory');
    }
}

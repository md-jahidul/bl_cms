<?php
namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Services\StoreCategoryService;
use App\Services\StoreService;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * @var StoreService
     */
    protected $storeService;

    /**
     * @var StoreCategoryService
     */
    protected $storeCategoryService;


    /**
     * StoreController constructor.
     * @param StoreService $storeService
     * @param StoreCategoryService $storeCategoryService
     */
    public function __construct(
        StoreService $storeService,
        StoreCategoryService $storeCategoryService
    ) {
        $this->storeService = $storeService;
        $this->storeCategoryService = $storeCategoryService;
        $this->middleware('auth');
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = $this->storeService->findAll();
        $category =  $this->storeCategoryService->findAll();
        return view('admin.store.store.index')
            ->with('category', $category)
            ->with('stores', $stores);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stores = $this->storeService->findAll();
        $categories =  $this->storeCategoryService->findAll();
        return view('admin.store.store.create')
            ->with('categories', $categories)
            ->with('stores', $stores);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $content = $this->storeService->storeMyBlStore($request->all())->getContent();
        session()->flash('message', $content);
        return redirect(route('myblStore.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $store = $this->storeService->findOne($id, 'StoreCategory');

        return view('admin.store.store.index')
            ->with('store', $store);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = $this->storeCategoryService->findAll();
        return view('admin.store.store.edit')
            ->with('categories', $categories)
            ->with('store', $this->storeService->findOne($id));
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
        $content = $this->storeService->updateStore($request->all(), $id)->getContent();
        session()->flash('success', $content);
        return redirect(route('myblStore.index'));
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
        session()->flash('error', $this->storeService->deleteStore($id)->getContent());
        return url('myblStore');
    }

}

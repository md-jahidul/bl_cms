<?php

namespace App\Http\Controllers\AssetLite;

use App\Enums\ExplorCStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExploreCRequest;
use App\Services\ExploreCService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\ExploreCDetailsService;

class ExploreCController extends Controller
{
    public const PAGE_TYPE = "explore_c";
    protected $exploreCService;
    protected $exploreCDetailsService;

    public function __construct( ExploreCService $exploreCService, ExploreCDetailsService $exploreCDetailsService)
    {
        $this->exploreCService = $exploreCService;
        $this->exploreCDetailsService = $exploreCDetailsService;

    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $exploreCs = $this->exploreCService->exploreCList();

        return view('admin.explore-c.index', compact('exploreCs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allPages = $this->exploreCDetailsService->findBy(['type' => self::PAGE_TYPE]);
        $pages = [];
        foreach ($allPages as $key => $page) {
            $row['url_slug'] = $page->url_slug;
            $row['page_name_en'] = $page->page_name_en;
            $pages[] = $row;
        }
        return view('admin.explore-c.create', compact('pages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExploreCRequest $request)
    {
        // // $data = [];
        // if ($request->file('img')) {
        //     $file = $request->img;
        //     $path = $file->storeAs(
        //         'explore_c/images',
        //         'explore_c_' . strtotime(now()) . '.' . $file->getClientOriginalExtension(),
        //         'public'
        //     );

        //     $img = $path;
        // }
        // $data = $request->all();
        // $data['img'] = $img;
        // return $this->exploreCService->store($request->all());
        session()->flash('message', $this->exploreCService->store($request->all())->getContent());
        return redirect(route('explore-c.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $exploreC = $this->exploreCService->findOne($id);
        $allPages = $this->exploreCDetailsService->findBy(['type' => self::PAGE_TYPE]);
        $pages = [];
        foreach ($allPages as $key => $page) {
            $row['url_slug'] = $page->url_slug;
            $row['page_name_en'] = $page->page_name_en;
            $pages[] = $row;
        }
        return view('admin.explore-c.edit', compact('exploreC', 'pages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExploreCRequest $request, $id)
    {
        // return $request->route()->parameters();
        // return $request->all();
        // return $this->exploreCService->updateExploreC($request->all(),$id);
        session()->flash('message', $this->exploreCService->updateExploreC($request->all(), $id)->getContent());
        return redirect(route('explore-c.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        session()->flash('message', $this->exploreCService->destroy($id)->getContent());
        return redirect(route('explore-c.index'));
        
    }

    public function exploreCSortable(Request $request)/*: Response*/
    {
        return $this->exploreCService->tableSortable($request->all());
        
    }

}

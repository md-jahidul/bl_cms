<?php

namespace App\Http\Controllers\AssetLite;

use App\Enums\ExplorCStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExploreCRequest;
use App\Services\ExploreCService;
use App\Services\MetaTagService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\ExploreCDetailsService;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class ExploreCController extends Controller
{
    public const PAGE_TYPE = "explore_c";
    protected $exploreCService;
    protected $exploreCDetailsService;
    /**
     * @var MetaTagService
     */
    private $metaTagService;

    public function __construct(
        ExploreCService $exploreCService,
        ExploreCDetailsService $exploreCDetailsService,
        MetaTagService $metaTagService
    ) {
        $this->exploreCService = $exploreCService;
        $this->exploreCDetailsService = $exploreCDetailsService;
        $this->metaTagService = $metaTagService;

    }

        /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $exploreCs = $this->exploreCService->exploreCList();
        $metaTag = $this->metaTagService->findMetaTagByKey(self::PAGE_TYPE);
        return view('admin.explore-c.index', compact('exploreCs', 'metaTag'));
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
     * @param ExploreCRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(ExploreCRequest $request)
    {
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
     * @param Request $request
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

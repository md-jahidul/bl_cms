<?php

namespace App\Http\Controllers\AssetLite\Page;

use App\Helpers\ComponentHelper;
use App\Http\Controllers\Controller;
use App\Models\PageComponent;
use App\Services\Page\PageService;
use App\Services\Page\PgComponentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PageController extends Controller
{
    private $pageService;
    /**
     * @var PgComponentService
     */
    private $pgComponentService;

    /**
     * @param PageService $pageService
     */
    public function __construct(
        PageService $pageService,
        PgComponentService $pgComponentService
    ) {
        $this->pageService = $pageService;
        $this->pgComponentService = $pgComponentService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page = $this->pageService->findBySlug('career');
        $components = $this->pgComponentService->findBy(['page_id' => $page->id], 'componentData');
        return view('admin.career.components.index', compact('components', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $pageId = $request['section_id'];
        $componentTypes = ComponentHelper::components()['all'];
        return view('admin.career.components.create', compact('pageId', 'componentTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->pageService->storePage($request->all());
        return Redirect::route('pages.index')->with('success', 'Page Create Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // dd($id);

//        $components = PageComponent::where('page_id', $id)->orderBy("order", "asc")->get();
//
//        return Inertia::render('Pages/Components/index', [
//            "pageId" => $id,
//            "componentas" => $components
//        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $page = $this->pageService->findOne($id);
//        return Inertia::render('Pages/Edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->pageService->updatePage($request->all(), $id);
        return Redirect::route('pages.index')->with('success', 'Page update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->pageService->destroy($id);
        return redirect()->route('pages.index')->with('success', 'Page Deleted Successfully');
    }
}

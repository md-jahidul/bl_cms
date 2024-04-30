<?php

namespace App\Http\Controllers\AssetLite\Page;

use App\Helpers\ComponentHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\DynamicPageStoreRequest;
use App\Models\PageComponent;
use App\Services\Page\PageService;
use App\Services\Page\PgComponentService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

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

    public function index()
    {
        $pages = $this->pageService->findAll();
        return view('admin.new-pages.list', compact('pages'));
    }

    public function create()
    {
        return view('admin.new-pages.create');
    }

    public function edit($id)
    {
        $page = $this->pageService->findOne($id);
        return view('admin.new-pages.create', compact('page'));
    }

    public function store(Request $request)
    {
        $response = $this->pageService->storePage($request->all());
        Session::flash('success', $response->getContent());
        return redirect('/pages');
    }

    public function deletePage($id)
    {
        $this->pageService->destroy($id);
        return url('/pages');
    }
}

<?php

namespace App\Http\Controllers\AssetLite;

use App\Services\AlFaqCategoryService;
use App\Services\AlFaqService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class AlFaqController extends Controller
{
    /**
     * @var AlFaqService
     */
    private $faq;
    /**
     * @var AlFaqCategoryService
     */
    private $alFaqCategoryService;

    /**
     * RolesController constructor.
     * @param AlFaqCategoryService $alFaqCategoryService
     * @param AlFaqService $faq
     */
    public function __construct(
        AlFaqCategoryService $alFaqCategoryService,
        AlFaqService $faq
    ) {
        $this->alFaqCategoryService = $alFaqCategoryService;
        $this->faq = $faq;
    }

    public function categoryList()
    {
        $categories = $this->alFaqCategoryService->findAll();
        return view('admin.al-faq.category-list', compact('categories'));
    }

    public function catEdit($id)
    {
        $category = $this->alFaqCategoryService->findOne($id);
        return view('admin.al-faq.category-edit', compact('category'));
    }

    public function catUpdate(Request $request, $id)
    {
        $response = $this->alFaqCategoryService->catUpdate($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect("faq-categories");
    }

    /**
     * Display a listing of the resource.
     *
     * @param $slug
     * @return Application|Factory|View
     */
    public function index($slug)
    {
        $faqs = $this->faq->getFaqs($slug);
        return view('admin.al-faq.index', compact('faqs', 'slug'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $slug
     * @return Application|Factory|View
     */
    public function create($slug)
    {
        $category = $this->alFaqCategoryService->getFaqsCategory(['slug' => $slug]);

        $for = null;

        if ($category->model != null) {
            $for = $category->model::where('type','explore_c')->get();
        }

        return view('admin.al-faq.create', compact('slug', 'for'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param $slug
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request, $slug)
    {
        $response = $this->faq->storeAlFaq($request->all(), $slug);
        Session::flash('message', $response->getContent());
        return redirect("faq/$slug");
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @param $slug
     * @return Application|Factory|View
     */
    public function edit($slug, $id)
    {
        $category = $this->alFaqCategoryService->getFaqsCategory(['slug' => $slug]);

        $for = null;

        if ($category->model != null) {
            $for = $category->model::All();
        }

        $faq = $this->faq->findOne($id);
        return view('admin.al-faq.edit', compact('faq', 'slug', 'for'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @param $slug
     * @return Application|RedirectResponse|Redirector
     */
    public function update(Request $request, $slug, $id)
    {
        $response = $this->faq->updateFaq($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect("faq/$slug");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @param $slug
     * @return Application|RedirectResponse|Redirector
     * @throws Exception
     */
    public function destroy($slug, $id)
    {
        $this->faq->deleteFaq($id);
        return url("faq/$slug");
    }
}

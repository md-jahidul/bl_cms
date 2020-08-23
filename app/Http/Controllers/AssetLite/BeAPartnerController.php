<?php

namespace App\Http\Controllers\AssetLite;

use App\Services\AlFaqCategoryService;
use App\Services\AlFaqService;
use App\Services\BeAPartnerService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class BeAPartnerController extends Controller
{
    /**
     * @var BeAPartnerService
     */
    private $beAPartnerService;

    /**
     * RolesController constructor.
     * @param BeAPartnerService $beAPartnerService
     */
    public function __construct(
        BeAPartnerService $beAPartnerService
    )
    {
        $this->beAPartnerService = $beAPartnerService;
    }

    public function getBeAPartner()
    {
        $beAPartner = $this->beAPartnerService->beAPartnerData();
        return view('admin.be-a-partner.landing-page', compact('beAPartner'));
    }

    public function beAPartnerEdit($id)
    {
        $beAPartner = $this->beAPartnerService->findOrFail($id);
        return view('admin.be-a-partner.landing-page-edit', compact('beAPartner'));
    }

    public function beAPartnerSave(Request $request, $id)
    {
        $response = $this->beAPartnerService->beAPartnerUpdate($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect('be-a-partner');
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
        return view('admin.al-faq.create', compact('slug'));
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
        $faq = $this->faq->findOne($id);
        return view('admin.al-faq.edit', compact('faq', 'slug'));
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

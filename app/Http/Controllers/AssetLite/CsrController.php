<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Requests\BlogPostRequest;
use App\Services\AlFaqService;
use App\Services\MediaBannerImageService;
use App\Services\MediaPressNewsEventService;
use App\Services\MediaNewsCategoryService;
use Bookworm\Bookworm;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class CsrController extends Controller
{
    /**
     * @var AlFaqService
     */
    private $mediaPNE;

    protected const REFERENCE_TYPE = "csr";
    /**
     * @var MediaBannerImageService
     */
    private $mediaBannerImageService;
    /**
     * @var MediaNewsCategoryService
     */
    protected $mediaNewsCategoryService;

    /**
     * RolesController constructor.
     * @param MediaPressNewsEventService $mediaPressNewsEventService
     * @param MediaBannerImageService $mediaBannerImageService
     * @param MediaNewsCategoryService $mediaNewsCategoryService
     */
    public function __construct(
        MediaPressNewsEventService $mediaPressNewsEventService,
        MediaBannerImageService $mediaBannerImageService,
        MediaNewsCategoryService $mediaNewsCategoryService
    ) {
        $this->mediaPNE = $mediaPressNewsEventService;
        $this->mediaBannerImageService = $mediaBannerImageService;
        $this->mediaNewsCategoryService = $mediaNewsCategoryService;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
       $blogPosts = $this->mediaPNE->findByReferenceType(self::REFERENCE_TYPE);
        return view('admin.al-csr.post.index', compact('blogPosts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $categories = $this->mediaNewsCategoryService->findAll();
        return view('admin.al-csr.post.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BlogPostRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(BlogPostRequest $request)
    {
        $response = $this->mediaPNE->storePNE($request->all(), self::REFERENCE_TYPE);
        Session::flash('success', $response->getContent());
        return redirect('csr-post');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $blogPost = $this->mediaPNE->findOne($id);
        $categories = $this->mediaNewsCategoryService->findAll();
        return view('admin.al-csr.post.edit', compact('blogPost','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Application|RedirectResponse|Redirector
     */
    public function update(BlogPostRequest $request, $id)
    {
        $response = $this->mediaPNE->updatePNE($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect('csr-post');
    }

    public function bannerUpload(Request $request)
    {
        $response = $this->mediaBannerImageService->bannerImageUpload($request->all());
        Session::flash('message', $response->getContent());
        return redirect('csr-post');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy($id)
    {
        $this->mediaPNE->deletePNE($id);
        return url('csr-post');
    }
}

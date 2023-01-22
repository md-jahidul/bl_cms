<?php

namespace App\Http\Controllers\AssetLite;

use App\Services\AlFaqService;
use App\Services\MediaBannerImageService;
use App\Services\MediaPressNewsEventService;
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

class BlogController extends Controller
{
    /**
     * @var AlFaqService
     */
    private $mediaPNE;

    protected const LATEST_NEWS = "latest_news";
    protected const FEATURED_TOPICS = "featured_topics";
    protected const NEWS_ARCHIVE = "news_archive";
    protected const REFERENCE_TYPE = "blog";
    /**
     * @var MediaBannerImageService
     */
    private $mediaBannerImageService;

    /**
     * RolesController constructor.
     * @param MediaPressNewsEventService $mediaPressNewsEventService
     * @param MediaBannerImageService $mediaBannerImageService
     */
    public function __construct(
        MediaPressNewsEventService $mediaPressNewsEventService,
        MediaBannerImageService $mediaBannerImageService
    ) {
        $this->mediaPNE = $mediaPressNewsEventService;
        $this->mediaBannerImageService = $mediaBannerImageService;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $blogPosts = $this->mediaPNE->findByReferenceType(self::REFERENCE_TYPE);
        return view('admin.blog.post.index', compact('blogPosts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.blog.post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $response = $this->mediaPNE->storePNE($request->all(), self::REFERENCE_TYPE);
        Session::flash('success', $response->getContent());
        return redirect('blog-post');
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
        return view('admin.blog.post.edit', compact('blogPost'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Application|RedirectResponse|Redirector
     */
    public function update(Request $request, $id)
    {
        $request['read_time'] = Bookworm::estimate($request->short_details_bn, '');
        $response = $this->mediaPNE->updatePNE($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect('blog-post');
    }

    public function bannerUpload(Request $request)
    {
        $response = $this->mediaBannerImageService->bannerImageUpload($request->all());
        Session::flash('message', $response->getContent());
        return redirect('blog-post');
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
        return url('blog-post');
    }
}

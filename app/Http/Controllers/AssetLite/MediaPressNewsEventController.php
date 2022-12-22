<?php

namespace App\Http\Controllers\AssetLite;

use App\Services\AlFaqService;
use App\Services\MediaBannerImageService;
use App\Services\MediaPressNewsEventService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class MediaPressNewsEventController extends Controller
{
    /**
     * @var AlFaqService
     */
    private $mediaPNE;

    protected const PRESS_RELEASE = "press_release";
    protected const NEWS_EVENT = "news_event";
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
        $pressNewsEvents = $this->mediaPNE->findAll();
        $pressBannerImage = $this->mediaBannerImageService->getBannerImage(self::PRESS_RELEASE);
        $newsBannerImage = $this->mediaBannerImageService->getBannerImage(self::NEWS_EVENT);
        return view('admin.media.list_press_news_event', compact('pressNewsEvents', 'pressBannerImage', 'newsBannerImage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.media.create_press_news_event');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $request->validate([
           'thumbnail_image_name_en' => 'unique:media_press_news_events,thumbnail_image_name_en',
           'thumbnail_image_name_bn' => 'unique:media_press_news_events,thumbnail_image_name_bn',
           'details_image_name_en' => 'unique:media_press_news_events,details_image_name_en',
           'details_image_name_bn' => 'unique:media_press_news_events,details_image_name_bn',
        ]);
        $response = $this->mediaPNE->storePNE($request->all());
        Session::flash('success', $response->getContent());
        return redirect('press-news-event');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $pressNewsEvent = $this->mediaPNE->findOne($id);
        return view('admin.media.edit_press_news_event', compact('pressNewsEvent'));
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
        $request->validate([
            'thumbnail_image_name_en' => 'unique:media_press_news_events,thumbnail_image_name_en,' . $id,
            'thumbnail_image_name_bn' => 'unique:media_press_news_events,thumbnail_image_name_bn,' . $id,
            'details_image_name_en' => 'unique:media_press_news_events,details_image_name_en,' . $id,
            'details_image_name_bn' => 'unique:media_press_news_events,details_image_name_bn,' . $id,
        ]);
        $response = $this->mediaPNE->updatePNE($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect('press-news-event');
    }

    public function bannerUpload(Request $request)
    {
        $request->validate([
           'banner_name_en' => 'unique:media_banner_images,banner_name_en,' . $request->press_release_id,
           'banner_name_bn' => 'unique:media_banner_images,banner_name_bn,' . $request->press_release_id,
           'news_banner_name_en' => 'unique:media_banner_images,banner_name_en,' . $request->news_event_id,
           'news_banner_name_bn' => 'unique:media_banner_images,banner_name_bn,' . $request->news_event_id,
        ]);
        $response = $this->mediaBannerImageService->bannerImageUpload($request->all());
        Session::flash('message', $response->getContent());
        return redirect('press-news-event');
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
        return url('press-news-event');
    }
}

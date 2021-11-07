<?php

namespace App\Http\Controllers\AssetLite;

use App\Services\AlFaqService;
use App\Services\MediaBannerImageService;
use App\Services\MediaPressNewsEventService;
use App\Services\MediaTvcVideoService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class MediaTvcVideoController extends Controller
{
    /**
     * @var MediaTvcVideoService
     */
    private $mediaTvcVideo;

    protected const MODULE_TYPE = "tvc_video";
    /**
     * @var MediaBannerImageService
     */
    private $mediaBannerImageService;

    /**
     * RolesController constructor.
     * @param MediaTvcVideoService $mediaTvcVideoService
     * @param MediaBannerImageService $mediaBannerImageService
     */
    public function __construct(
        MediaTvcVideoService $mediaTvcVideoService,
        MediaBannerImageService $mediaBannerImageService
    ) {
        $this->mediaTvcVideo = $mediaTvcVideoService;
        $this->mediaBannerImageService = $mediaBannerImageService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $tvcVideos = $this->mediaTvcVideo->findAll();
        $bannerImage = $this->mediaBannerImageService->getBannerImage(self::MODULE_TYPE);
        return view('admin.media.list_tvc_video', compact('tvcVideos', 'bannerImage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.media.create_tvc_video');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $response = $this->mediaTvcVideo->storeTvcVideo($request->all());
        Session::flash('success', $response->getContent());
        return redirect('tvc-video');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $tvcVideo = $this->mediaTvcVideo->findOne($id);
        return view('admin.media.edit_tvc_video', compact('tvcVideo'));
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
        $response = $this->mediaTvcVideo->updateTvcVideo($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect('tvc-video');
    }

    public function bannerUpload(Request $request)
    {
        $request->validate([
           'banner_name_en' => 'unique:media_banner_images,banner_name_en,' . $request->tvc_banner_id,
           'banner_name_bn' => 'unique:media_banner_images,banner_name_bn,' . $request->tvc_banner_id,
        ]);
        $response = $this->mediaBannerImageService->tvcBannerUpload($request->all(), self::MODULE_TYPE);
        Session::flash('message', $response->getContent());
        return redirect('tvc-video');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy($id)
    {
        $this->mediaTvcVideo->deleteTvcVideo($id);
        return url('tvc-video');
    }
}

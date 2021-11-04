<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\WelcomeBannerStoreRequest;
use App\Services\WelcomeBannerService;
use Illuminate\Support\Facades\Session;

class WelcomeBannerController extends Controller
{
    private $welcomeBannerService;

    public function __construct(WelcomeBannerService $welcomeBannerService)
    {
        $this->welcomeBannerService = $welcomeBannerService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $welcome_banners = $this->welcomeBannerService->findAll();

        return view('admin.welcome-banner.index', compact('welcome_banners'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.welcome-banner.create-edit');
    }

    /**
     * @param WelcomeBannerStoreRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(WelcomeBannerStoreRequest $request)
    {
        $this->welcomeBannerService->storeWelcomeBanner($request->except('_token', '_method'));
        Session::flash('message','Welcome Banner stored successfully');

        return redirect('welcome-banner');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $welcome_banner = $this->welcomeBannerService->findOne($id);

        return view('admin.welcome-banner.create-edit', compact('welcome_banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(WelcomeBannerStoreRequest $request, $id)
    {
        $this->welcomeBannerService->updateWelcomeBanner($request->except('_token', '_method'), $id);
        Session::flash('message','Welcome Banner Updated successfully');

        return redirect('welcome-banner');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->welcomeBannerService->deleteWelcomeBanner($id);
        Session::flash('message','Welcome Banner Deleted successfully');

        return redirect('welcome-banner');
    }
}

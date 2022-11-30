<?php

namespace App\Http\Controllers\CMS;

use App\Repositories\ContentDeeplinkRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContentDeeplinkController extends Controller
{

    protected  $contentDeeplinkRepository;

    public function __construct(ContentDeeplinkRepository $contentDeeplinkRepository)
    {
        $this->contentDeeplinkRepository = $contentDeeplinkRepository;
    }

    public function index()
    {

        $contentDeeplinkItem = $this->contentDeeplinkRepository->getAllData();

        return view('admin.deeplink.index', compact('contentDeeplinkItem'));
    }

    public function store(Request $request)
    {
        $response = $this->contentDeeplinkRepository->store($request->all());
        session()->flash('message', 'Create Successfully');
        return redirect(route('content-deeplink.index'));
    }

    public function destroy($id)
    {
        $this->contentDeeplinkRepository->destroy($id);

        return url(route('content-deeplink.index'));
    }

}

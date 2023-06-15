<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\InternetGiftContentRequest;
use App\Services\InternetGiftContentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redis;


class InternetGiftContentController extends Controller
{
    protected  $internetGiftContentService;
    public function __construct(InternetGiftContentService $internetGiftContentService)
    {
        $this->internetGiftContentService = $internetGiftContentService;

    }

    public function index()
    {
        $internetGiftContents = $this->internetGiftContentService->getGiftContent();
        return view('admin.internet-gift-content.index', compact('internetGiftContents'));
    }


    public function create()
    {
        return view('admin.internet-gift-content.create');
    }


    public function store(InternetGiftContentRequest $request)
    {
        if($this->internetGiftContentService->storeInternetGiftContent($request->all())) {
            session()->flash('message', 'Content Created Successfully');
        } else {
            session()->flash('error', 'Content Created Failed');
        }

        return redirect('internet-gift-content');
    }


    public function edit($contentId)
    {
        $internetGiftContent = $this->internetGiftContentService->findOne($contentId);

        return view('admin.internet-gift-content.edit', compact('internetGiftContent'));
    }


    public function update(InternetGiftContentRequest $request, $contentId)
    {

        if($this->internetGiftContentService->updateInternetGiftContent($request->all(), $contentId)) {
            session()->flash('message', 'Content Updated Successfully');
        } else {
            session()->flash('error', 'Content Updated Failed');
        }

        return redirect('internet-gift-content');

    }

    public function updatePosition(Request $request)
    {
        return $this->internetGiftContentService->tableSortable($request);
    }


    public function destroy($contentId)
    {
        $giftContent = $this->internetGiftContentService->findOne($contentId);

        if ($giftContent) {
            $this->internetGiftContentService->deleteInternetGiftCOntent($contentId);
            
            session()->flash('error', 'Content Deleted Successfully');
        } else {
            session()->flash('error', 'Content Deleted Failed');
        }

        return redirect()->back();
    }
}

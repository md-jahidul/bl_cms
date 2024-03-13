<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\ContentFilter;
use App\Models\NewCampaignModality\MyBlCampaignSection;
use App\Services\ContentFilterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ContentFilterController extends Controller
{
    public $service;

    public function __construct(ContentFilterService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $orderBy = ['column' => 'display_order', 'direction' => 'ASC'];
        $filterContents = $this->service->findAll(null, null, $orderBy);

        return view('admin.content-filters.index', compact('filterContents'));
    }

    public function create()
    {
        return view('admin.content-filters.create');
    }

    public function store(Request $request)
    {
        if ($this->service->save($request->all())) {
            Session::flash('message', 'Section store successful');
        } else {
            Session::flash('danger', 'Section Stored Failed');
        }

        return redirect('content-filter');
    }

    public function edit($filterId)
    {
        $content = $this->service->findOne($filterId);

        return view('admin.content-filters.edit', compact('content'));
    }

    public function update(Request $request, $filterId)
    {
        if ($this->service->update($filterId, $request->all())) {
            Session::flash('message', 'Section Update successful');
        } else {
            Session::flash('danger', 'Section Update Failed');
        }

        return redirect('content-filter');
    }

    public function destroy($filterId)
    {
        $this->service->delete($filterId);
        return redirect('content-filter');
    }

    public function categorySortable(Request $request)
    {
        return $this->service->tableSort($request);
    }
}

<?php

namespace App\Http\Controllers\CMS\Feed;

use App\Models\Feed;
use App\Models\FeedCategory;
use App\Services\Feed\FeedService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeedController extends Controller
{
    protected $service;

    public function __construct(FeedService $service)
    {
        $this->service = $service;
    }

    public function create($source)
    {
        $source_view_mapping = [
            'youtube' => 'admin.feed.youtube.create',
            'facebook' => 'admin.feed.facebook.create',
            'custom' => 'admin.feed.custom.create',
        ];

        if (!array_key_exists($source, $source_view_mapping)) {
            abort(404);
        }

        $category = FeedCategory::orderBy('sort', 'asc')->get();

        return view($source_view_mapping[$source], compact('category', 'source'));
    }


    public function store(Request $request, $source)
    {
        switch ($source) {
            case 'youtube':
                return $this->service->saveYoutubeFeed($request);
                break;
            case 'facebook':
                return $this->service->saveFacebookFeed($request);
                break;
            case 'custom':
                return $this->service->saveCustomFeed($request);
                break;
        }
    }

    public function index(Request $request)
    {
        $feeds = $this->service->getFeedsWithPagination($request, 15);

        //dd($feeds->toArray());

        return view('admin.feed.index', compact('feeds'));
    }

    public function show(Feed $feed)
    {
        $source_view_mapping = [
            'youtube' => 'admin.feed.youtube.show',
            'facebook' => 'admin.feed.facebook.show',
            'custom' => 'admin.feed.custom.show',
        ];

        return view($source_view_mapping[strtolower($feed->source)], compact('feed'));
    }
}

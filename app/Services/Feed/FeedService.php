<?php

namespace App\Services\Feed;

use App\Enums\FeedSource;
use App\Enums\FeedStatus;
use App\Enums\FeedType;
use App\Models\Feed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

/**
 * Class FeedService
 * @package App\Services\Feed
 */
class FeedService
{

    /**
     * @param  Request  $request
     * @param  int  $number_of_items
     * @return string
     */
    public function getFeedsWithPagination(Request $request, $number_of_items = 15)
    {
        return Feed::with('category')->paginate($number_of_items);
    }

    /**
     * @param  Request  $request
     * @return string
     */
    public function saveYoutubeFeed(Request $request)
    {
        try {
            $path = null;
            $data = [];
            if ($request->hasFile('preview_image')) {
                $file = $request->file('preview_image');
                $path = $file->storeAs(
                    'feeds/youtube/' . strtotime(now() . '/'),
                    "preview_image" . '.' . $file->getClientOriginalExtension(),
                    'public'
                );
            }

            $data = [
                'category_id' => $request->category_id,
                'type' => FeedType::VIDEO,
                'source' => FeedSource::YOUTUBE,
                'title' => $request->title,
                'description' => $request->description,
                'video_url' => $request->video_url,
                'preview_image' => $path,
                'created_by' => auth()->id()

            ];

            Feed::create($data);
            $request->session()->flash('success', 'Feed Successfully Saved');
           /* return redirect()->route("feed.create", 'youtube');*/
            return Redirect::back();
        } catch (\Exception $e) {
            $request->session()->flash('error', $e->getMessage());
           /* return redirect()->route("feed.create", 'youtube');*/
            return Redirect::back();
        }
    }

    public function updateYoutubeFeed(Feed $feed, Request $request)
    {
        $path = null;
        if ($request->hasFile('preview_image')) {
            $file = $request->file('preview_image');
            $path = $file->storeAs(
                'feeds/youtube/' . strtotime(now() . '/'),
                "preview_image" . '.' . $file->getClientOriginalExtension(),
                'public'
            );

            $data['preview_image'] = $path;
        }

        $data['category_id'] = $request->category_id;
        $data['title'] = $request->title;
        $data['description'] = $request->description;
        $data['video_url'] = $request->video_url;
        $data['created_by'] = auth()->id();

        $feed->update($data);
        $request->session()->flash('success', 'Feed Successfully Updated');
        /*return redirect()->route("feed.edit", $feed);*/
        return Redirect::back();
    }

    /**
     * @param  Request  $request
     * @return string
     */
    public function saveFacebookFeed(Request $request)
    {
        return 'sha';
    }

    /**
     * @param  Request  $request
     * @return string
     */
    public function saveCustomFeed(Request $request)
    {
        return 'saa';
    }
}

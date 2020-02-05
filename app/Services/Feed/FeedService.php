<?php

namespace App\Services\Feed;

use App\Enums\FeedSource;
use App\Enums\FeedStatus;
use App\Enums\FeedType;
use App\Models\Feed;
use Illuminate\Http\Request;
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
     * @param $view_url
     */
    public function getYoutubeEmbedUrl($view_url)
    {
        $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
        $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))([a-zA-Z0-9_-]+)/i';
        $youtube_id = null;

        if (preg_match($longUrlRegex, $view_url, $matches)) {
            $youtube_id = $matches[count($matches) - 1];
        }

        if (preg_match($shortUrlRegex, $view_url, $matches)) {
            $youtube_id = $matches[count($matches) - 1];
        }
        return 'https://www.youtube.com/embed/' . $youtube_id ;
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
                'category_id'   => $request->category_id,
                'type'          => FeedType::VIDEO,
                'source'        => FeedSource::YOUTUBE,
                'title'         => $request->title,
                'description'   => $request->description,
                'video_url'     => $request->video_url,
                'preview_image' => $request->preview_image,
                'created_by'   => auth()->id()

            ];

            Feed::create($data);
            $request->session()->flash('success', 'Feed Successfully Saved');
            return redirect()->route("feed.create", 'youtube');
        } catch (\Exception $e) {
            $request->session()->flash('error', $e->getMessage());
            return redirect()->route("feed.create", 'youtube');
        }
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

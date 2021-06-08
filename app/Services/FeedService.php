<?php

namespace App\Services;

use App\Models\MyBlFeed;
use App\Repositories\FeedRepository;
use App\Traits\CrudTrait;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class FeedService
{
    use CrudTrait;

    /**
     * @var FeedRepository
     */
    protected $feedRepository;

    /**
     * FeedService constructor.
     * @param FeedRepository $feedRepository
     */
    public function __construct(FeedRepository $feedRepository)
    {
        $this->feedRepository = $feedRepository;
        $this->setActionRepository($feedRepository);
    }

    public function feeds()
    {
        return $this->feedRepository->findByProperties([], ['title']);
    }

    /**
     * Get all feeds
     *
     * @return array
     */
    public function getDataFeeds($request)
    {
        try {
            $draw = $request->get('draw');
            $start = $request->get('start');
            $length = $request->get('length');

            $builder = new MyBlFeed();

            $builder = $builder->withCount(['feedHitCounts' => function ($query) use ($request) {
                if ($request->date_range != null) {
                    $date = explode('--', $request->date_range);
                    $from = Carbon::createFromFormat('Y/m/d', $date[0])->toDateString();
                    $to = Carbon::createFromFormat('Y/m/d', $date[1])->toDateString();
                    $query->whereBetween('date', [$from, $to]);
                }
                $query->select(DB::raw('sum(count)'));
            }]);

            $builder = $builder->whereHas('category', function ($q) use ($request) {
                if ($request->category) {
                    $q->where('slug', $request->category);
                }
            })->with('category');

            if ($request->title) {
                $builder = $builder->where('title', $request->title);
            }

            if ($request->type) {
                $builder = $builder->where('type', $request->type);
            }

            $all_items_count = $builder->count();
            $data = $builder->skip($start)->take($length)->orderBy('created_at', 'DESC')->get();
            return [
                'data' => $data,
                'draw' => $draw,
                'recordsTotal' => $all_items_count,
                'recordsFiltered' => $all_items_count
            ];
        } catch (\Exception $e) {
            return [
                'success' => 0,
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * Store feed in the db.
     *
     * @param array $data
     * @return Response
     */
    public function store(array $data)
    {
        if (isset($data['image_url'])) {
            $data['image_url'] = 'storage/' . $data['image_url']->store('image_url');
        }

        if (isset($data['file'])) {
            $data['file'] = 'storage/' . $data['file']->store('file');
        }
        $data['show_in_home'] = isset($data['show_in_home']);

//        dd($data);
        $this->feedRepository->save($data);
        return new Response("Feed has been successfully created");
    }

    /**
     * Update feed in the db
     *
     * @param array $data
     * @param $id
     * @return Response
     */
    public function feedUpdate(array $data, $id)
    {
        if (isset($data['image_url'])) {
            $data['image_url'] = 'storage/' . $data['image_url']->store('image_url');
        }

        if (isset($data['file'])) {
            $data['file'] = 'storage/' . $data['file']->store('file');
        }
        $data['show_in_home'] = isset($data['show_in_home']);
        $feed = $this->feedRepository->findOne($id);
        $this->feedRepository->update($feed, $data);
        return new Response("Feed has been successfully updated");
    }

    /**
     * Delete feed in the db
     *
     * @param $id
     * @return Response
     * @throws Exception
     */
    public function destroy($id)
    {
        $this->delete($id);
        return new Response("Feed has been successfully deleted");
    }
}

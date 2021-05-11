<?php

namespace App\Services;

use App\Models\MyBlFeed;
use App\Repositories\FeedRepository;
use App\Traits\CrudTrait;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

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

    /**
     * Get all feeds
     *
     * @return void
     */
    public function getDataFeeds($request)
    {
//        return $this->feedRepository->getFeeds();

        try {
            $draw = $request->get('draw');
            $start = $request->get('start');
            $length = $request->get('length');

            $builder = new MyBlFeed();

            if ($request->star_count) {
                $builder = $builder->where('rating', $request->star_count);
            }

            if ($request->order[0]['column'] == 2) {
//                dd($request->order);
                $builder = $builder->orderBy('rating', $request->order[0]['dir']);
            }

            $builder = $builder->whereHas('category', function ($q) use ($request) {
                if ($request->category) {
                    $q->where('page_name', 'LIKE', "%$request->page_name%");
                }
            }
            )->with('category');

//            if ($request->date_range != null) {
//                $date = explode('-', $request->date_range);
//                $from = str_replace('/', '-', $date[0]) . " " . "00:00:00";
//                $to = str_replace('/', '-', $date[1]) . " " . "23:59:00";
//                $builder = $builder->whereBetween('created_at', [$from, $to]);
//            }

            $all_items_count = $builder->count();

            $data = $builder->skip($start)->take($length)->orderBy('created_at', 'DESC')->get();

//            dd($data);

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

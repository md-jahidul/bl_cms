<?php

namespace App\Repositories;

use App\Models\FeedCategoryHitCountMsisdn;
use App\Models\MyblDeeplinkMsisdnCount;
use App\Models\MyBlFeedCategory as FeedCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class FeedCategoryRepository extends BaseRepository
{
    protected $modelName = FeedCategory::class;

    /**
     * All category
     * @return mixed
     */
    public function getAllCategory()
    {
        return $this->model->orderBy('ordering')->get();
    }

    /**
     * Get all active category
     * @return mixed
     */
    public function getAllActiveCategory()
    {
        return $this->model->where('status', 1)->orderBy('ordering')->get();
    }


    /**
     * Update ordering position
     *
     * @param $request
     */
    public function updateOrderingPosition($request)
    {
        $positions = $request->position;
        foreach ($positions as $position) {
            $categoryId = $position[0];
            $newPosition = $position[1];
            $updateCategory = $this->model->find($categoryId);
            $updateCategory['ordering'] = $newPosition;
            $updateCategory->update();
        }
    }

    public function getFeedCatWithDeeplinkInfo($data, $slug)
    {
        $from = "";
        $to = "";
        if (isset($data->date_range_deeplink)) {
            $date = explode(' - ', $data->date_range_deeplink);
            $from = Carbon::createFromFormat('Y/m/d', $date[0])->toDateString();
            $to = Carbon::createFromFormat('Y/m/d', $date[1])->toDateString();
        }
        return $this->model->where('slug', $slug)
            ->with([
               'dynamicLinks' => function ($q) use ($from, $to) {
                   $q->with(['deeplinkMsisdnHitCounts' => function ($q) use ($from, $to) {
                       if (!empty($from)) {
                           $q->whereBetween('created_at', [$from . ' 00:00:00', $to . ' 23:59:59']);
                       }
                   }]);
               }])
           ->first();
    }

    public function hitCountByfeedCatId($request, $slug)
    {
        $from = "";
        $to = "";
        if (isset($request->date_range)) {
            $date = explode(' - ', $request->date_range);
            $from = Carbon::createFromFormat('Y/m/d', $date[0])->toDateString();
            $to = Carbon::createFromFormat('Y/m/d', $date[1])->toDateString();
        }
        return $this->model->where('slug', $slug)
            ->with([
               'categoryInAppHitCounts' => function ($q) use ($from, $to) {
                   if (!empty($from)) {
                       $q->whereBetween('created_at', [$from . ' 00:00:00', $to . ' 23:59:59']);
                   }
               }])
            ->first();
    }

    public function feedCatHitMsisdnCount($request, $feedCatId)
    {
        $builder = new FeedCategoryHitCountMsisdn();
        $builder = $builder->where('feed_category_id', $feedCatId);

        if (isset($request->date_range)) {
            $date = explode(' - ', $request->date_range);
            $from = Carbon::createFromFormat('Y/m/d', $date[0])->toDateString();
            $to = Carbon::createFromFormat('Y/m/d', $date[1])->toDateString();
            $builder = $builder->whereBetween('created_at', [$from . ' 00:00:00', $to . ' 23:59:59']);
        }

        $data = $builder
            ->select(DB::raw('msisdn, count(*) as hit_count'))
            ->groupBy('msisdn')
            ->orderBy('hit_count', "DESC")
            ->get();

        if (isset($request->excel_export)) {
            return $data;
        }

        $all_items_count = $data->count();
        $start = $request->get('start');
        $length = $request->get('length');
        $data = collect($data)->slice($start, $length);

        $draw = $request->get('draw');

        return [
            'data' => array_values($data->toArray()),
            'draw' => $draw,
            'recordsTotal' => $all_items_count,
            'recordsFiltered' => $all_items_count
        ];
    }
}

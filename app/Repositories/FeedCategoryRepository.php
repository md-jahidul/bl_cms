<?php

namespace App\Repositories;

use App\Models\MyBlFeedCategory as FeedCategory;
use Carbon\Carbon;

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
        if (isset($data->date_range)) {
            $date = explode(' - ', $data->date_range);
            $from = Carbon::createFromFormat('Y/m/d', $date[0])->toDateString();
            $to = Carbon::createFromFormat('Y/m/d', $date[1])->toDateString();
        }
        return $this->model->where('slug', $slug)
            ->with([
               'dynamicLinks' => function ($q) use ($from, $to) {
                   if (!empty($from)) {
                       $q->whereBetween('created_at', [$from . ' 00:00:00', $to . ' 23:59:59']);
                   }
               }])
           ->first();
    }
}

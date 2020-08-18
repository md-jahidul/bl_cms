<?php

namespace App\Repositories;

use App\Models\MyBlFeedCategory as FeedCategory;

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
}

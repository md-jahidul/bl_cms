<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;

use App\Models\FaqCategory;
use App\Models\FaqQuestion;
use App\Repositories\NotificationCategoryRepository;
use App\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class FaqCategoryService
{

    public function getAll()
    {
        return new FaqCategory();
    }

    public function store(Request $request, $platform)
    {
        try {
            FaqCategory::create([
                'title' => $request->title,
                'platform' => $platform,
            ]);

            return response()->json([
                'status' => 'SUCCESS',
                'message' => 'New FAQ Category Added Successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => ' FAILED',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request)
    {
        $category = FaqCategory::where('slug', $request->slug)->first();

        if (!$category) {
            return response()->json([
                'status' => ' FAILED',
                'message' => 'Category not found'
            ], 404);
        }

        // check if this title is alreday taken
        $duplicateCategory = FaqCategory::where([
            [
                'title',
                '=',
                $request->title
            ],
            [
                'id',
                '<>',
                $category->id
            ]
        ])->first();

        if ($duplicateCategory) {
            return response()->json([
                'status' => ' FAILED',
                'message' => 'This title is already taken'
            ], 200);
        }


        $category->update([
            'title' => $request->title
        ]);

        return response()->json([
            'status' => 'SUCCESS',
            'message' => 'Successfully Updated'
        ]);
    }

    public function prepareDataForDatatable(Builder $itemBuilder, Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        //dd($length);

        $all_items_count = $itemBuilder->count();

        // $items = $itemBuilder->paginate($length, ['*'], null, (int)$start / $length + 1);

        $items = $itemBuilder->withCount('questions')->skip($start)->take($length)->get();

        $response = [
            'draw' => $draw,
            'recordsTotal' => $all_items_count,
            'recordsFiltered' => $all_items_count,
            'data' => []
        ];

        $items->each(function ($item) use (&$response) {
            $response['data'][] = [
                'id' => $item->id,
                'slug' => $item->slug,
                'title' => $item->title,
                'questions_count' => $item->questions_count
            ];
        });

        return $response;
    }

    public function destroy(Request $request)
    {
        DB::beginTransaction();
        try {
            $category = FaqCategory::where('slug', $request->slug)->first();
            $category->delete();

            // delete questions also

            FaqQuestion::where('category_id', $category->id)->delete();

            DB::commit();

            return response()->json([
                'status' => 'SUCCESS',
                'message' => 'Successfully Deleted'
            ]);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'status' => 'FAILED',
                'message' => 'Successfully Updated'
            ], 500);
        }
    }
}

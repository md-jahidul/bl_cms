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
use http\Url;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class FaqQuestionsService
{

    public function getAll()
    {
        return new FaqQuestion();
    }

    public function store(Request $request, $platform)
    {
        try {
            FaqQuestion::create([
                'category_id' => $request->category,
                'question' => $request->question,
                'answer' => $request->answer,
                'platform' => $platform,
            ]);

            session()->flash('success', 'New FAQ Question Added Successfully');
            return redirect()->route('faq.questions.create');
        } catch (\Exception $e) {
            session()->flash('error', 'Internal Server Error. Try later.');
            return back();
        }
    }

    public function prepareDataForDatatable(Builder $itemBuilder, Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');

        if ($request->filter_category != '') {
            $itemBuilder->where('category_id', $request->filter_category);
        }

        $all_items_count = $itemBuilder->count();

        $items = $itemBuilder->with('category')->skip($start)->take($length)->get();

        $response = [
            'draw' => $draw,
            'recordsTotal' => $all_items_count,
            'recordsFiltered' => $all_items_count,
            'data' => []
        ];

        $items->each(function ($item) use (&$response) {
            $response['data'][] = [
                'id' => $item->id,
                'category' => $item->category->title,
                'question' => $item->question,
                'answer' => $item->answer
            ];
        });

        return $response;
    }

    public function update($id, Request $request)
    {
        $question = FaqQuestion::findOrFail($id);

        $question->update([
            'category_id' => $request->category,
            'question' => $request->question,
            'answer' => $request->answer,
        ]);

        session()->flash('success', 'FAQ Question Updated Successfully');
        return back();
    }

    public function delete(Request $request)
    {
        FaqQuestion::find($request->id)->delete();

        return response()->json([
            'status' => ' SUCCESS',
            'message' => 'FAQ Question Deleted Successfully'
        ], 200);
    }
}

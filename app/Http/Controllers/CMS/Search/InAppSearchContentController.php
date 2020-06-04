<?php

namespace App\Http\Controllers\CMS\Search;

use App\Http\Requests\StoreInAppSearchContentRequest;
use App\Http\Requests\UpdateInAppSearchContentRequest;
use App\Models\MyBlProduct;
use App\Models\MyBlSearchContent;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

/**
 * Class InAppSearchContentController
 * @package App\Http\Controllers\CMS\Search
 */
class InAppSearchContentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('admin.my-bl-search.content_entry');
    }

    /**
     * @param  StoreInAppSearchContentRequest  $request
     * @return RedirectResponse
     */
    public function store(StoreInAppSearchContentRequest $request)
    {
        try {
            MyBlSearchContent::create(
                [
                    'display_title' => $request->display_title,
                    'description' => $request->description,
                    'search_content' => json_encode($request->search_content),
                    'navigate_action' => $request->navigation_action,
                    'other_contents' => isset($request->other_info) ? json_encode(
                        [
                            'type' => strtolower($request->navigation_action),
                            'content' => $request->other_info
                        ]
                    ) : null,
                ]
            );


            return redirect()->route('search-content.index')->with('success', 'New Search content added');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function index()
    {
        $search_contents = MyBlSearchContent::paginate(7);

        return view('admin.my-bl-search.index', compact('search_contents'));
    }

    public function edit(MyBlSearchContent $search_content)
    {
        $builder = new MyBlProduct();
        $builder = $builder->where('status', 1);

        $product_list = $builder->whereHas(
            'details',
            function ($q) {
                $q->whereIn('content_type', ['data', 'voice', 'sms']);
            }
        )->get();

        $products = [];

        foreach ($product_list as $product) {
            $products [] = [
                'id' => $product->details->product_code,
                'text' => '(' . strtoupper($product->details->content_type) . ') ' . $product->details->commercial_name_en
            ];
        }

        return view('admin.my-bl-search.edit', compact('search_content', 'products'));
    }

    public function update(UpdateInAppSearchContentRequest $request, $id)
    {
        $data ['display_title'] = $request->display_title;
        $data['search_content'] = json_encode($request->tag);
        $data ['description'] = $request->description;
        $data ['navigation_action'] = $request->navigation_action;
        if (isset($data['other_contents'])) {
            $other_attributes = [
                'type' => strtolower($data['navigation_action']),
                'content' => $data['other_attributes']
            ];

            $data['other_attributes'] = $other_attributes;
        };

        $pop_up = MyBlSearchContent::find($id);

        $pop_up->update($data);

        return redirect()->back()->with('success', 'Successfully Updated');
    }

    public function destroy($id)
    {
        $pop_up = MyBlSearchContent::findOrFail($id);
        $pop_up->delete();

        return redirect()->back()->with('success', 'Successfully Deleted');
    }
}

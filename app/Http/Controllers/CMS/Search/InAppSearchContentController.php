<?php

namespace App\Http\Controllers\CMS\Search;

use App\Http\Requests\StoreInAppSearchContentRequest;
use App\Http\Requests\UpdateInAppSearchContentRequest;
use App\Models\MyBlProduct;
use App\Models\MyBlSearchContent;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;

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
                    'search_content' => implode(', ', $request->tag),
                    'navigation_action' => $request->navigation_action,
                    'deeplink' => $request->deeplink,
                    'other_contents' => isset($request->other_info) ? json_encode(
                        [
                            'type' => strtolower($request->navigation_action),
                            'content' => $request->other_info
                        ]
                    ) : null,
                    'connection_type' => $request->connection_type
                ]
            );


            return redirect()->route('mybl-search-content.index')->with('success', 'New Search content added');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function index()
    {
        return view('admin.my-bl-search.index');
    }

    public function getSearchContents(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');

        $builder = new MyBlSearchContent();

        if ($request->terms) {
            $builder = MyBlSearchContent::search($request->terms);
        }

        $all_items_count = $builder->count();
        $items = $builder->orderBy('display_title')->skip($start)->take($length)->get();

        $response = [
            'draw' => $draw,
            'recordsTotal' => $all_items_count,
            'recordsFiltered' => $all_items_count,
            'data' => []
        ];

        $items->each(function ($item) use (&$response) {
            $response['data'][] = [
                'id'                => $item->id,
                'display_title'     => $item->display_title,
                'description'       => $item->display_title,
                'search_contents'   => $item->search_content,
                'navigation_action' => $item->navigation_action,
                'connection_type'    => $item->connection_type,
            ];
        });

        return $response;
    }

    public function edit(MyBlSearchContent $search_content)
    {
        $builder = new MyBlProduct();
        $builder = $builder->where('status', 1);

        $product_list = $builder->whereHas(
            'details',
            function ($q) {
                $q->whereIn('content_type', ['data', 'voice', 'sms', 'mix']);
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
        $data['search_content'] = implode(', ', $request->tag);
        $data ['description'] = $request->description;
        $data ['navigation_action'] = $request->navigation_action;
        $data ['deeplink'] = $request->deeplink;
        if (isset($data['other_contents'])) {
            $other_attributes = [
                'type' => strtolower($data['navigation_action']),
                'content' => $data['other_attributes']
            ];

            $data['other_attributes'] = $other_attributes;
        }

        $data['connection_type'] = $request->connection_type;

        $search_content = MyBlSearchContent::find($id);

        $search_content->update($data);

        return redirect()->back()->with('success', 'Successfully Updated');
    }

    public function destroy($id)
    {
        $pop_up = MyBlSearchContent::findOrFail($id);
        $pop_up->delete();

        return redirect()->back()->with('success', 'Successfully Deleted');
    }
}

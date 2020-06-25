<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Services\InternetPackFilterService;
use App\Services\MinutePackFilterService;
use App\Services\MixedBundleFilterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class MinutePackFilterController
 * @package App\Http\Controllers\CMS
 */
class MinutePackFilterController extends Controller
{
    protected $service;

    public function __construct()
    {
        $this->middleware('auth');
        $this->service = new MinutePackFilterService();
    }

    public function create()
    {
        $existing_sort_filters = $this->service->getAll()->sort()->active()->get();

        $sort_filters = [];
        foreach ($existing_sort_filters as $item) {
            $filters = json_decode($item->filter, true);
            $sort_filters [] = $filters['value'];
        }
        return view('admin.offer-minute.config.create', compact('sort_filters'));
    }

    public function getPriceFilter(Request $request)
    {
        $builder = $this->service->getAll()->price()->active();

        return $this->service->preparePriceFilterForDatatable($builder, $request);
    }


    public function getMinuteFilter(Request $request)
    {
        $builder = $this->service->getAll()->minute()->active();

        return $this->service->preparePriceFilterForDatatable($builder, $request);
    }

    public function getValidityFilter(Request $request)
    {
        $builder = $this->service->getAll()->validity()->active();

        return $this->service->preparePriceFilterForDatatable($builder, $request);
    }

    public function savePriceFilter(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'lower' => 'required|numeric|max:2000',
                'upper' => 'numeric|gt:lower|max:2000'
            ]
        );

        if ($validate->fails()) {
            $response = [
                'success' => 'FAILED',
                'errors'  => $validate->errors()->first()
            ];
            return response()->json($response, 422);
        }

        return $this->service->addFilter($request, 'price', 'tk.');
    }

    public function deleteFilter(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'id' => 'required|exists:minutes_pack_filters,id'
            ]
        );

        if ($validate->fails()) {
            $response = [
                'success' => 'FAILED',
                'errors'  => $validate->errors()->first()
            ];
            return response()->json($response, 422);
        }

        return $this->service->delFilter($request);
    }

    public function saveMinuteFilter(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'lower' => 'required|numeric|max:2000',
                'upper' => 'numeric|gt:lower|max:2000'
            ]
        );

        if ($validate->fails()) {
            $response = [
                'success' => 'FAILED',
                'errors'  => $validate->errors()->first()
            ];
            return response()->json($response, 422);
        }

        return $this->service->addFilter($request, 'minutes', 'minutes');
    }


    public function saveValidityFilter(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'lower' => 'required|numeric|max:365',
                'upper' => 'numeric|gt:lower|max:365'
            ]
        );

        if ($validate->fails()) {
            $response = [
                'success' => 'FAILED',
                'errors'  => $validate->errors()->first()
            ];
            return response()->json($response, 422);
        }

        return $this->service->addFilter($request, 'validation', 'days');
    }

    public function saveSortFilter(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'filters' => 'required|array',
            ]
        );

        if ($validate->fails()) {
            $response = [
                'success' => 'FAILED',
                'errors'  => $validate->errors()->first()
            ];
            return response()->json($response, 422);
        }

        return $this->service->addSortFilter($request);
    }
}

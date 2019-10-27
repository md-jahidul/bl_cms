<?php

namespace App\Http\Controllers\CMS;

use App\Models\MixedBundleFilter;
use App\Services\MixedBundleFilterService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class MixedBundleFilterController extends Controller
{
    /**
     * @var MixedBundleFilterService
     */
    protected $service;

    public function __construct()
    {
        $this->middleware('auth');
        $this->service = new MixedBundleFilterService();
    }

    public function create()
    {
        $existing_sort_filters = $this->service->getAll()->sort()->active()->get();

        $sort_filters = [];
        foreach ($existing_sort_filters as $item) {
            $filters = json_decode($item->filter, true);
            $sort_filters [] = $filters['value'];
        }
        return view('admin.offer-mixedbundle.config.create', compact('sort_filters'));
    }

    public function getPriceFilter(Request $request)
    {
        $builder = $this->service->getAll()->price()->active();

        return $this->service->preparePriceFilterForDatatable($builder, $request);
    }

    public function getInternetFilter(Request $request)
    {
        $builder = $this->service->getAll()->internet()->active();

        return $this->service->preparePriceFilterForDatatable($builder, $request);
    }

    public function getMinutesFilter(Request $request)
    {
        $builder = $this->service->getAll()->minutes()->active();

        return $this->service->preparePriceFilterForDatatable($builder, $request);
    }

    public function getSmsFilter(Request $request)
    {
        $builder = $this->service->getAll()->sms()->active();

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
                'id' => 'required|exists:mixed_bundle_filters,id'
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

    public function saveInternetFilter(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'lower' => 'required|numeric|max:102400',
                'upper' => 'numeric|gt:lower|max:102400'
            ]
        );

        if ($validate->fails()) {
            $response = [
                'success' => 'FAILED',
                'errors'  => $validate->errors()->first()
            ];
            return response()->json($response, 422);
        }

        return $this->service->addFilter($request, 'internet', 'mb');
    }

    public function saveMinutesFilter(Request $request)
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

    public function saveSmsFilter(Request $request)
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

        return $this->service->addFilter($request, 'sms', 'sms');
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

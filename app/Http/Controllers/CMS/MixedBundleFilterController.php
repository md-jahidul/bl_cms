<?php

namespace App\Http\Controllers\CMS;

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
        return view('admin.offer-mixedbundle.config.create');
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

    public function savePriceFilter(Request $request)
    {
        $validate = Validator::make($request->all(),
            [
                'lower' => 'required|numeric',
                'upper' => 'numeric'
            ]
        );

        if ($validate->fails()) {
            $response = [
                'success' =>'FAILED',
                'errors'  => $validate->errors()->first()
            ];
            return response()->json($response, 422);
        }

        return $this->service->addFilter($request,'price','tk.');

    }

    public function deleteFilter(Request $request)
    {
        $validate = Validator::make($request->all(),
            [
                'id' => 'required|exists:mixed_bundle_filters,id'
            ]
        );

        if ($validate->fails()) {
            $response = [
                'success' =>'FAILED',
                'errors'  => $validate->errors()->first()
            ];
            return response()->json($response, 422);
        }

        return $this->service->delFilter($request);
    }

    public function saveInternetFilter(Request $request)
    {
        $validate = Validator::make($request->all(),
            [
                'lower' => 'required|numeric',
                'upper' => 'numeric'
            ]
        );

        if ($validate->fails()) {
            $response = [
                'success' =>'FAILED',
                'errors'  => $validate->errors()->first()
            ];
            return response()->json($response, 422);
        }

        return $this->service->addFilter($request,'internet','mb');

    }

    public function saveMinutesFilter(Request $request)
    {
        $validate = Validator::make($request->all(),
            [
                'lower' => 'required|numeric',
                'upper' => 'numeric'
            ]
        );

        if ($validate->fails()) {
            $response = [
                'success' =>'FAILED',
                'errors'  => $validate->errors()->first()
            ];
            return response()->json($response, 422);
        }

        return $this->service->addFilter($request,'minutes','minutes');

    }

    public function saveSmsFilter(Request $request)
    {
        $validate = Validator::make($request->all(),
            [
                'lower' => 'required|numeric',
                'upper' => 'numeric'
            ]
        );

        if ($validate->fails()) {
            $response = [
                'success' =>'FAILED',
                'errors'  => $validate->errors()->first()
            ];
            return response()->json($response, 422);
        }

        return $this->service->addFilter($request,'sms','sms');

    }
}

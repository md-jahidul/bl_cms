<?php


namespace App\Services;


use App\Model\MixedBundleFilter;
use App\Models\OfferFilterType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MixedBundleFilterService
{
    protected $filter_types = [];

    public function __construct()
    {
        $this->filter_types = OfferFilterType::all()->pluck('id', 'slug');
    }

    public function getAll(){
        return new MixedBundleFilter();
    }

    public function preparePriceFilterForDatatable(Builder $itemBuilder, Request $request)
    {
        $draw = $request->get('draw');
        $all_items_count = $itemBuilder->count();
        $items = $itemBuilder->get();

        $response = [
            'draw'  =>  $draw,
            'recordsTotal'  =>  $all_items_count,
            'recordsFiltered'  =>  $all_items_count,
            'data'  =>  []
        ];

        $items->each(function($item) use (&$response){

            $filter = json_decode($item->filter,true);

            $response['data'][] = [
                'id'      =>  $item->id,
                'lower'   =>  $filter['lower'],
                'upper'   =>  $filter['upper'],
                'unit'   =>  $filter['unit']
            ];
        });

        $collection = collect($response['data']);

        $sorted = $collection->sortBy('lower');

        $response['data'] = $sorted->values()->all();
        return $response;

    }

    public function addFilter(Request $request, $type,$unit)
    {
        $lower = $request->lower;
        $upper = $request->upper;

        try {
            MixedBundleFilter::create([
                'offer_filter_type_id' => $this->filter_types[$type],
                'filter' => json_encode([
                    'lower' => $lower,
                    'upper' => $upper,
                    'unit'  => $unit
                ]),
            ]);

            $response = [
                'status' => 'SUCCESS',
                'message' => 'Filter Added Successfully'
            ];

            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => ' FAILED',
                'message' => $e->getMessage()
            ], 500);
        }

    }

    public function delFilter(Request $request)
    {
        try{
            $filter = MixedBundleFilter::find($request->id);
            $filter->delete();
            $response = [
                'status' => 'SUCCESS',
                'message' => 'Filter deleted Successfully'
            ];

            return response()->json($response, 200);

        }catch (\Exception $e){
            return response()->json([
                'status' => ' FAILED',
                'message' => $e->getMessage()
            ], 500);
        }
    }


    public function addSortFilter(Request $request)
    {
        DB::beginTransaction();

        try{

            // first delete previous data and save new data. Done with transaction.if fails revert operation
            DB::table('mixed_bundle_filters')
                ->where('offer_filter_type_id',$this->filter_types['sort'])
                ->delete();

            //save
            $filters = $request->filters;
            foreach ($filters as $filter){
                MixedBundleFilter::create([
                    'offer_filter_type_id' => $this->filter_types['sort'],
                    'filter' => json_encode([
                        'name'  => $filter['name'],
                        'value' => $filter['value']
                    ]),
                ]);
            }
            $response = [
                'status' => 'SUCCESS',
                'message' => 'Filter Added Successfully'
            ];

            DB::commit();

            return response()->json($response, 200);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => ' FAILED',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}

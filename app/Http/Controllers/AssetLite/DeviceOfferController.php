<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Controllers\Controller;
use App\Models\DeviceOffer;
use Illuminate\Http\Request;
use Box\Spout\Common\Type;
use Box\Spout\Reader\Common\Creator\ReaderFactory;

class DeviceOfferController extends Controller {

    private $deviceOffer;

    /**
     * EasyPaymentCardController constructor.
     * @param EasyPaymentCard $easyPaymentCard
     */
    public function __construct(DeviceOffer $deviceOffer) {
        $this->deviceOffer = $deviceOffer;
    }

    /**
     * Display a listing of the resource.
     * 
     * @param $type
     * @return Factory|View
     * @Bulbul Mahmud Nito || 04/02/2020
     */
    public function index() {
        $brands = $this->deviceOffer->select('brand')->groupBy('brand')->get();
        return view('admin.device-offer.index', compact('brands'));
    }

    public function deviceOfferList(Request $request) {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');

        $builder = $this->deviceOffer->where('brand', '!=', NULL);

        if ($request->brand != null) {
            $builder->where('brand', $request->brand);
        }



        $all_items_count = $builder->count();
        $items = $builder->skip($start)->take($length)->get();

        $response = [
            'draw' => $draw,
            'recordsTotal' => $all_items_count,
            'recordsFiltered' => $all_items_count,
            'data' => []
        ];

        $items->each(function ($item) use (&$response) {
            $statusBtn = "<a href='$item->id' class='btn-sm btn-success offer_change_status'>Showing</a>";
            if ($item->status == 0) {
                $statusBtn = "<a href='$item->id' class='btn-sm btn-warning offer_change_status'>Hidden</a>";
            }
            
            $freeData = "<small><strong>One:</strong> " . $item->free_data_one .
                "<br>" . "<strong>Two:</strong> " . $item->free_data_two .
                "<br>" . "<strong>Three:</strong> " . $item->free_data_three . "</small>";
            
            $bonusData = "<small><strong>One:</strong> " . $item->bonus_data_one .
                "<br>" . "<strong>Two:</strong> " . $item->bonus_data_two .
                "<br>" . "<strong>Three:</strong> " . $item->bonus_data_three . "</small>";
            
            $response['data'][] = [
                'id' => $item->id,
                'brand' => $item->brand,
                'model' => $item->model,
                'free_data' => $freeData,
                'bonus_data' => $bonusData,
                'available_shop' => $item->available_shop,
                'status' => $statusBtn
            ];
        });

        return $response;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function uploadOfferByExcel(Request $request) {

        try {

            $this->validate($request, [
                'offer_file' => 'required|mimes:xls,xlsx'
            ]);

            $reader = ReaderFactory::createFromType(Type::XLSX); // for XLSX files
            $path = $request->file('offer_file')->getRealPath();
            $reader->open($path);

            $insertdata = [];
            foreach ($reader->getSheetIterator() as $sheet) {
                $rowNumber = 1;
                foreach ($sheet->getRowIterator() as $row) {
                    $cells = $row->getCells();

                    if ($rowNumber > 1) {
                        $insertdata[] = array(
                            'brand' => $cells[0]->getValue(),
                            'model' => $cells[1]->getValue(),
                            'free_data_one' => $cells[2]->getValue(),
                            'free_data_two' => $cells[3]->getValue(),
                            'free_data_three' => $cells[4]->getValue(),
                            'bonus_data_one' => $cells[5]->getValue(),
                            'bonus_data_two' => $cells[6]->getValue(),
                            'bonus_data_three' => $cells[7]->getValue(),
                            'available_shop' => $cells[8]->getValue()
                        );
                    }
                    $rowNumber++;
                }
            }

            if (!empty($insertdata)) {
                $this->deviceOffer->insert($insertdata);
            }

            $response = [
                'success' => 'SUCCESS'
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = [
                'success' => 'FAILED',
                'errors' => $e->getMessage()
            ];
            return response()->json($response, 500);
        }
    }

    public function offerStatusChange(Request $request) {

        try {
            $offerId = $request->offerId;
            $offer = $this->deviceOffer->findOrFail($offerId);

            $status = $offer->status == 1 ? 0 : 1;
            $offer->status = $status;
            $offer->save();

            $response = [
                'success' => 1
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = [
                'success' => 0,
                'errors' => $e->getMessage()
            ];
            return response()->json($response, 500);
        }
    }

    public function deleteDeviceOffer($offerId) {

        try {
            $offer = $this->deviceOffer->findOrFail($offerId);
            $offer->delete();

            $response = [
                'success' => 1
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = [
                'success' => 0,
                'errors' => $e->getMessage()
            ];
            return response()->json($response, 500);
        }
    }

}

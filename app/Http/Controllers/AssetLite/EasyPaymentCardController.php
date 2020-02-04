<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Controllers\Controller;
use App\Models\EasyPaymentCard;
use Illuminate\Http\Request;
use Box\Spout\Common\Type;
use Box\Spout\Reader\Common\Creator\ReaderFactory;

class EasyPaymentCardController extends Controller {

    private $easyPaymentCard;

    /**
     * EasyPaymentCardController constructor.
     * @param EasyPaymentCard $easyPaymentCard
     */
    public function __construct(EasyPaymentCard $easyPaymentCard) {
        $this->easyPaymentCard = $easyPaymentCard;
    }

    /**
     * Display a listing of the resource.
     * 
     * @param $type
     * @return Factory|View
     * @Bulbul Mahmud Nito || 02/02/2020
     */
    public function index() {
        $divisions = $this->easyPaymentCard->select('division')->groupBy('division')->get();
        return view('admin.easy-payment-card.index', compact('divisions'));
    }

    public function getEasyPaymentCardList(Request $request) {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');

        $builder = $this->easyPaymentCard->where('division', '!=', NULL);

        if ($request->division != null) {
            $builder->where('division', $request->division);
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
            $statusBtn = "<a href='$item->id' class='btn-sm btn-success card_change_status'>Showing</a>";
            if ($item->status == 0) {
                $statusBtn = "<a href='$item->id' class='btn-sm btn-warning card_change_status'>Hidden</a>";
            }
            $response['data'][] = [
                'id' => $item->id,
                'code' => $item->code,
                'division' => $item->division,
                'area' => $item->area,
                'branch_name' => $item->branch_name,
                'address' => $item->address,
                'status' => $statusBtn
            ];
        });

        return $response;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function uploadCardByExcel(Request $request) {

        try {

            $this->validate($request, [
                'product_file' => 'required|mimes:xls,xlsx'
            ]);

            $reader = ReaderFactory::createFromType(Type::XLSX); // for XLSX files
            $path = $request->file('product_file')->getRealPath();
            $reader->open($path);

            $insertdata = [];
            foreach ($reader->getSheetIterator() as $sheet) {
                $rowNumber = 1;
                foreach ($sheet->getRowIterator() as $row) {
                    $cells = $row->getCells();

                    if ($rowNumber > 1) {
                        $insertdata[] = array(
                            'code' => $cells[0]->getValue(),
                            'division' => $cells[1]->getValue(),
                            'area' => $cells[2]->getValue(),
                            'branch_name' => $cells[3]->getValue(),
                            'address' => $cells[4]->getValue(),
                        );
                    }
                    $rowNumber++;
                }
            }

            if (!empty($insertdata)) {
                $this->easyPaymentCard->insert($insertdata);
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

    public function cardStatusChange(Request $request) {

        try {
            $cardId = $request->cardId;
            $card = $this->easyPaymentCard->findOrFail($cardId);

            $status = $card->status == 1 ? 0 : 1;
            $card->status = $status;
            $card->save();

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

    public function deletePaymentCard($cardId) {

        try {
            $card = $this->easyPaymentCard->findOrFail($cardId);
            $card->delete();

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

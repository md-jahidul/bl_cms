<?php


namespace App\Services;

use App\Traits\CrudTrait;
//use http\Env\Request;
use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\PushNotificationProductPurchase;
use App\Repositories\PushNotificationProductPurchaseRepository;
use DataTables;

class PushNotificationProductPurchaseService
{

    use CrudTrait;

    /**
     * @var PushNotificationProductPurchaseRepository
     */
    protected $productPurchase;

    /**
     * PushNotificationProductPurchaseService constructor.
     * @param PushNotificationProductPurchaseRepository $productPurchase
     */
    public function __construct(PushNotificationProductPurchaseRepository $productPurchase)
    {
        $this->productPurchase=$productPurchase;

    }

    public function getPurchaseList(){
//   return $this->productPurchase->findAll();
        $data = $this->productPurchase->findAll()->where('is_delete', 0);
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('total_view', function ($data) {
                return $data->total_buy + $data->total_cancel + $data->total_buy_attempt;
            })
            ->addColumn('action', function ($row) {
                $url ='#'; //route('agent.deeplink.report.details', $row->id);
                $actionBtn = '<a href="' . $url . '" class="edit btn btn-success btn-sm">view</a>';
//                $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(Request $request){

    }
}

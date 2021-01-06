<?php


namespace App\Services;

use App\Traits\CrudTrait;

//use http\Env\Request;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\PushNotificationProductPurchaseDetails;

;

use App\Models\PushNotificationProductPurchase;
use App\Repositories\PushNotificationProductPurchaseRepository;
use App\Repositories\PushNotificationProductPurchaseDetailsRepository;
use DataTables;

class PushNotificationProductPurchaseService
{

    use CrudTrait;

    /**
     * @var PushNotificationProductPurchaseRepository
     */
    protected $productPurchaseRepository;
    protected $productPurchaseDetailsRepository;

    /**
     * PushNotificationProductPurchaseService constructor.
     * @param PushNotificationProductPurchaseRepository $productPurchaseRepository
     * @param PushNotificationProductPurchaseDetailsRepository $productPurchaseDetailsRepository
     */
    public function __construct(
        PushNotificationProductPurchaseRepository $productPurchaseRepository,
        PushNotificationProductPurchaseDetailsRepository $productPurchaseDetailsRepository
    )
    {
        $this->productPurchaseRepository = $productPurchaseRepository;
        $this->productPurchaseDetailsRepository = $productPurchaseDetailsRepository;
        $this->setActionRepository($productPurchaseRepository);

    }

    /**
     * @param $request
     * @return mixed
     */
    public function getPurchaseFilteredList($request)
    {
        if ($request->has('searchByTitle') && !empty($request->input('searchByTitle'))) {
            $title = trim($request->input('searchByTitle'));
            $search = ['is_delete' => 0, 'notification_title' => "$title"];
        } else {
            $search = ['is_delete' => 0];
        }
        $data = $this->findBy($search);

        $searchByFromdate = ($request->has('searchByFromdate')) ? $request->input('searchByFromdate') : null;
        $searchByTodate = ($request->has('searchByTodate')) ? $request->input('searchByTodate') : null;
        $detailsData = $this->productPurchaseDetailsRepository->getCountsByActionType(
            $searchByFromdate,
            $searchByTodate
        );
        $from = is_null($searchByFromdate) ? Carbon::now()->subMonths(1)->toDateString() . ' 00:00:00' : Carbon::createFromFormat('Y-m-d H:i:s', $searchByFromdate . ' 00:00:00')->toDateTimeString();
        $to = is_null($searchByTodate) ? Carbon::now()->toDateString() . ' 23:59:59' : Carbon::createFromFormat('Y-m-d H:i:s', $searchByTodate . '23:59:59')->toDateTimeString();

        $result = [];
        foreach ($data as $key => $purchase) {
            $result[$key]['id'] = $purchase->id;
            $result[$key]['notification_id'] = $purchase->notification_id;
            $result[$key]['notification_title'] = $purchase->notification_title;
            $result[$key]['product_code'] = $purchase->product_code;

            $detailsDatum = $detailsData
                ->where('push_notification_product_purchase_id', $purchase->id)
                ->flatten()
                ->toArray();
            $result[$key]['log'] = $this->prepareFilteredCount($detailsDatum);
        }

        return Datatables::collection($result)
            ->addIndexColumn()
            ->addColumn('total_view', function ($result) {
                return $result['log']['total_buy'] + $result['log']['total_buy_attempt'] + $result['log']['total_cancel'];
            })
            ->addColumn('total_buy', function ($result) {
                return $result['log']['total_buy'];
            })
            ->addColumn('total_buy_attempt', function ($result) {
                return $result['log']['total_buy_attempt'];
            })
            ->addColumn('total_cancel', function ($result) {
                return $result['log']['total_cancel'];
            })
            ->addColumn('action', function ($result) use ($from, $to) {
                $url = route('push.notification.purchase.report.details', $result['id']);
                $actionBtn = '<a href="' . $url . '?from=' . $from . '&to=' . $to . '" class="edit btn btn-success btn-sm">view</a>';
//                $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);

    }

    /**
     * @param $detailsDatum
     * @return array
     */
    public function prepareFilteredCount($detailsDatum)
    {
        if (empty($detailsDatum)) {
            $array['total_buy'] = 0;
            $array['total_cancel'] = 0;
            $array['total_buy_attempt'] = 0;
        } else {
            $total_buy_attempt = 0;
            $total_cancel = 0;
            $total_buy = 0;
            foreach ($detailsDatum as $infolog) {
                if ($infolog['action_type'] == 'buy_failure') {
                    $total_buy_attempt = +$infolog['total_count'];
                }
                if ($infolog['action_type'] == 'buy_success') {
                    $total_buy = +$infolog['total_count'];
                }
                if ($infolog['action_type'] == 'cancel') {
                    $total_cancel = +$infolog['total_count'];
                }
            }
            $array['total_buy_attempt'] = $total_buy_attempt;
            $array['total_cancel'] = $total_cancel;
            $array['total_buy'] = $total_buy;
        }
        return $array;

    }

    /**
     * @param $request
     * @return mixed
     */
    public function getPurchaseList($request)
    {
        if ($request->has('searchByTitle') && !empty($request->input('searchByTitle'))) {
            $title = trim($request->input('searchByTitle'));
            $search = ['is_delete' => 0, 'notification_title' => "$title"];
        } else {
            $search = ['is_delete' => 0];
        }
        $data = $this->productPurchaseRepository->findBy($search);
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('total_view', function ($data) {
                return $data->total_buy + $data->total_cancel + $data->total_buy_attempt;
            })
            ->addColumn('action', function ($row) {
                $url = route('push.notification.purchase.report.details', $row->id);
                $actionBtn = '<a href="' . $url . '" class="edit btn btn-success btn-sm">view</a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * @param $id
     * @param $from
     * @param $to
     * @return mixed
     */
    public function getPurchaseDetailsList($id, $from, $to)
    {
        if (!empty($from) && !empty($to)) {
            $data = PushNotificationProductPurchaseDetails::where('push_notification_product_purchase_id', $id)->whereBetween('created_at', [$from, $to])->get();
        } else {
            $data = PushNotificationProductPurchaseDetails::where('push_notification_product_purchase_id', $id)->get();
        }
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('date', function ($data) {
                return date('d-m-Y', strtotime($data->created_at));
            })
            ->rawColumns(['date'])
            ->make(true);
    }
}

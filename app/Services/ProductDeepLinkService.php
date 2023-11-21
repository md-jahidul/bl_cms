<?php

namespace App\Services;

use App\Models\MyBlProduct;
use App\Models\ProductDeepLink;
use App\Models\ProductDeepLinkDetails;
use App\Traits\CrudTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use  App\Services\FirebaseDeepLinkService;
use  App\Repositories\ProductDeepLinkRepository;
use  App\Repositories\ProductDeepLinkDetailsRepository;
use DataTables;
use Carbon\Carbon;


class ProductDeepLinkService
{

    use CrudTrait;
    /**
     * @var \App\Services\FirebaseDeepLinkService
     */
    protected $firebaseDeepLinkService;
    /**
     * @var ProductDeepLinkRepository
     */
    protected $productDeepLinkRepository;
    /**
     * @var ProductDeepLinkDetailsRepository
     */
    protected $productDeepLinkDetailsRepository;

    /**
     * ProductDeepLinkService constructor.
     * @param \App\Services\FirebaseDeepLinkService $firebaseDeepLinkService
     * @param ProductDeepLinkRepository $productDeepLinkRepository
     * @param ProductDeepLinkDetailsRepository $productDeepLinkDetailsRepository
     */
    public function __construct(
        FirebaseDeepLinkService $firebaseDeepLinkService,
        ProductDeepLinkRepository $productDeepLinkRepository,
        ProductDeepLinkDetailsRepository $productDeepLinkDetailsRepository
    )
    {
        $this->firebaseDeepLinkService = $firebaseDeepLinkService;
        $this->productDeepLinkRepository = $productDeepLinkRepository;
        $this->productDeepLinkDetailsRepository = $productDeepLinkDetailsRepository;
    }

    /**
     * @param $product_code
     * @return array
     */
    public function createDeepLink($product_code)
    {
        $product = MyBlProduct::where('product_code', $product_code)->first();
        if (!$product) {
            return ['short_link' => "", 'status_code' => 404, 'ms' => "Product code not found"];
        }
        $body=[
            "dynamicLinkInfo"=>[
              "domainUriPrefix"=>env('DOMAINURIPREFIX'),
              "link"=>"https://banglalink.net/product/$product_code",
              "androidInfo"=> [
                "androidPackageName"=>"com.arena.banglalinkmela.app"
              ],
              "iosInfo"=>[
                "iosBundleId"=>"com.Banglalink.My-Banglalink"
              ]
            ]
        ];
        $productDeeplink = new ProductDeepLink();

        $oldDeeplink = $productDeeplink->where('product_code', $product_code)->select('product_code', 'deep_link')->first();

        if ($oldDeeplink){
            return ['short_link' => $oldDeeplink->deep_link, 'status_code' => 200, 'ms' => "Deeplink has already"];
        }

        $insert_item = array();
        $result = $this->firebaseDeepLinkService->post($body);
        if ($result['status_code'] == 200) {
            $shortLink = $result['response']['shortLink'];
            $insert_item['product_code'] = $product_code;
            $insert_item['deep_link'] = $shortLink;

            if ($productDeeplink->create($insert_item)) {
                return ['short_link' => "$shortLink", 'status_code' => $result['status_code'], 'ms' => "successfully created"];
            } else {
                return ['short_link' => "", 'status_code' => 500, 'ms' => "something is wrong"];
            }

        } else {
            return ['short_link' => "", 'status_code' => 500, 'ms' => "something is wrong"];
        }
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getProductDeepLinkListReport($request)
    {
        $model = ProductDeepLink::query();
        return DataTables::eloquent($model)
            ->filter(function ($query) {
                if (request()->has('searchByFromdate') && request()->has('searchByFromdate') && !empty(request()->input('searchByFromdate')) && !empty(request()->input('searchByTodate'))) {
                    $datefrom = request()->input('searchByFromdate') . ' 00:00:00';
                    $dateto = request()->input('searchByTodate') . ' 23:59:59';
                    $query->whereBetween('created_at', [$datefrom, $dateto]);
                }
            }, true)
            ->addIndexColumn()
            ->addColumn('total_view', function ($data) {
                return $data->total_buy + $data->total_cancel + $data->buy_attempt;
            })
            ->addColumn('total_buy_attempt', function ($data) {
                return $data->buy_attempt;
            })
            ->addColumn('action', function ($row) {
                $url = url('deeplink-product-purchase-details');
                $actionBtn = '<a href="' . $url . '/' . $row->id . '" class="edit btn btn-success btn-sm">view</a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getProductDeepLinkfilterList($request)
    {
        if ($request->has('searchByProductCode') && !empty($request->input('searchByProductCode'))) {
            $searchByProductCode = trim($request->input('searchByProductCode'));
            $data = ProductDeepLink::where('product_code', "$searchByProductCode")->get();
        } else {
            $data = $this->productDeepLinkRepository->findAll();
        }
        $searchByFromdate = ($request->has('searchByFromdate')) ? $request->input('searchByFromdate') : null;
        $searchByTodate = ($request->has('searchByTodate')) ? $request->input('searchByTodate') : null;
        $detailsData = $this->productDeepLinkDetailsRepository->getCountsByActionType(
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
                ->where('product_code_id', $purchase->id)
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
                $url = url('deeplink-product-purchase-details');
                $actionBtn = '<a href="' . $url . '/' . $result['id'] . '?from=' . $from . '&to=' . $to . '" class="edit btn btn-success btn-sm">view</a>';
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
     * @param $productDeeplinkDbId
     * @return mixed
     */
    public function getProductDeepLinkDetailsReport($request, $productDeeplinkDbId)
    {
        $from = ($request->has('from')) ? $request->input('from') : null;
        $to = ($request->has('to')) ? $request->input('to') : null;
        $builder = ProductDeepLinkDetails::where('product_code_id', $productDeeplinkDbId)->orderBy('id', 'DESC')->get();
        $result = $collection = collect($builder);
        if (!empty($from) && !empty($to)) {
            $filtered = $collection->whereBetween('created_at', [$from, $to]);
            $result = $filtered->all();
        }
        return Datatables::collection($result)
            ->addIndexColumn()
            ->addColumn('created_at', function ($result) {
                return  date("d-M-Y", strtotime($result->created_at));
            })
            ->make(true);
    }

}

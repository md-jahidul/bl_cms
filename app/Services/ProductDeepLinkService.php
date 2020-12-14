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

class ProductDeepLinkService
{

    use CrudTrait;

    /**
     * @var $firebaseDeepLinkService
     */
    protected $firebaseDeepLinkService;

    public function __construct(
        FirebaseDeepLinkService $firebaseDeepLinkService
    )
    {
        $this->firebaseDeepLinkService = $firebaseDeepLinkService;
    }


    public function createDeepLink($product_code)
    {

        $product = MyBlProduct::where('product_code', $product_code)->first();
        if (!$product) {
            throw new NotFoundHttpException();
        }
        $body = [
            "dynamicLinkInfo" => [
                "domainUriPrefix" => env('DOMAINURIPREFIX'),
                "link" => "https://banglalink.net/product/$product_code",
                "androidInfo" => [
                    "androidPackageName" => "com.arena.banglalinkmela.app.qa"
                ],
                "iosInfo" => [
                    "iosBundleId" => "com.Banglalink.My-Banglalink"
                ]
            ]
        ];
        $saveData = new ProductDeepLink();
        $insert_item = array();
        $result = $this->firebaseDeepLinkService->post($body);
        if ($result['status_code'] == 200) {
            $shortLink = $result['response']['shortLink'];
            $insert_item['product_code'] = $product_code;
            $insert_item['deep_link'] = $shortLink;

            if ($saveData->create($insert_item)) {
                return ['short_link' => "$shortLink", 'status_code' => $result['status_code'], 'ms' => "successfuly created"];
            } else {
                return ['short_link' => "", 'status_code' => 500, 'ms' => "something is wrong"];
            }

        } else {
            return ['short_link' => "", 'status_code' => 500, 'ms' => "something is wrong"];
        }

    }

    /**
     * @param $request
     * @return array
     * @author  Ahsan Habib
     */
    public function getProductDeepLinkListReport($request)
    {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');

        $builder = new ProductDeepLink();
        $builder->orderBy('id', 'desc');

        if ($request->has('search') && !empty($request->get('search'))) {
            $input = $request->get('search');
            if (!empty($input['value'])) {
                $product_code = $input['value'];
                $all_items_count = $builder->where('product_code', 'LIKE', "%{$product_code}%")->count();
                $items = $builder->where('product_code', 'LIKE', "%{$product_code}%")->skip($start)->take($length)->get();
            } else {

                $all_items_count = $builder->count();
                $items = $builder->skip($start)->take($length)->get();
            }
        }
        $response = [
            'draw' => $draw,
            'recordsTotal' => $all_items_count,
            'recordsFiltered' => $all_items_count,
            'data' => []
        ];
        $items->each(function ($item) use (&$response) {
            $created_at = date('d-M-Y', strtotime($item->created_at));
            $total_view = $item->total_cancel + $item->total_buy + $item->buy_attempt;
            $response['data'][] = [
                'id' => $item->id,
                'product_code' => $item->product_code,
                'deep_link' => $item->deep_link,
                'total_view' => $total_view,
                'total_buy' => $item->total_buy,
                'total_cancel' => $item->total_cancel,
                'buy_attempt' => $item->buy_attempt,
                'date' => $created_at];
        });
        return $response;
    }

    /**
     * @param $request
     * @return array
     * @author  Ahsan Habib
     */
    public function getProductDeepLinkDetailsReport($request, $productDeeplinkDbId)
    {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $builder = new ProductDeepLinkDetails();
        $builder->where('product_code_id', $productDeeplinkDbId);

        if ($request->has('search') && !empty($request->get('search'))) {
            $input = $request->get('search');
            if (!empty($input['value']) or !empty($request->get('option_name'))) {
                $product_code = $input['value'];
                $inputData = array();
                $inputData['msisdn'] = $input['value'];
                $inputData['action_type'] = $request->get('option_name');
                $inputData['product_code_id'] = $request->get('product_code_id');
                $all_items_count = $builder->where(function ($q) use ($inputData) {
                    $msisdn = $inputData['msisdn'];
                    $action_type = $inputData['action_type'];
                    $product_code_id = $inputData['product_code_id'];
                    $q->where('product_code_id', $product_code_id);
                    if (!empty($msisdn)) {
                        $q->where('msisdn', 'LIKE', "%{$msisdn}%");
                    }
                    if (!empty($action_type)) {
                        $q->where('action_type', 'LIKE', "%{$action_type}%");
                    }
                }
                )->count();
                $items = $builder->where(function ($q) use ($inputData) {
                    $msisdn = $inputData['msisdn'];
                    $action_type = $inputData['action_type'];
                    $product_code_id = $inputData['product_code_id'];
                    $q->where('product_code_id', $product_code_id);
                    if (!empty($msisdn)) {
                        $q->where('msisdn', 'LIKE', "%{$msisdn}%");
                    }
                    if (!empty($action_type)) {
                        $q->where('action_type', 'LIKE', "%{$action_type}%");
                    }
                }
                )->orderBy('id', 'desc')->skip($start)->take($length)->get();
            } else {

                $all_items_count = $builder->where('product_code_id', $productDeeplinkDbId)->count();
                $builder->orderBy('id', 'desc');
                $items = $builder->where('product_code_id', $productDeeplinkDbId)->skip($start)->take($length)->get();
            }
        }
        $response = [
            'draw' => $draw,
            'recordsTotal' => $all_items_count,
            'recordsFiltered' => $all_items_count,
            'data' => []
        ];
        $items->each(function ($item) use (&$response) {
            $created_at = date('d-M-Y', strtotime($item->created_at));
            $response['data'][] = [
                'msisdn' => $item->msisdn,
                'action_type' => $item->action_type,
                'action_status' => $item->action_status,
                'action_url' => $item->action_url,
                'date' => $created_at
            ];
        });
        return $response;
    }

}

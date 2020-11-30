<?php

namespace App\Services;

use App\Models\MyBlProduct;
use App\Models\ProductDeepLink;
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
    ) {
        $this->firebaseDeepLinkService=$firebaseDeepLinkService;
    }



    public function createDeepLink($product_code){

        $product = MyBlProduct::where('product_code', $product_code)->first();
        if (!$product) {
            throw new NotFoundHttpException();
        }
        $body=[
            "dynamicLinkInfo"=>[
              "domainUriPrefix"=>env('DOMAINURIPREFIX'),
              "link"=>"https://banglalink.net/product/$product_code",
              "androidInfo"=> [
                "androidPackageName"=>"com.arena.banglalinkmela.app.qa"
              ],
              "iosInfo"=>[
                "iosBundleId"=>"com.Banglalink.My-Banglalink"
              ]
            ]
        ];
        $saveData=new ProductDeepLink();
        $insert_item=array();
        $result=$this->firebaseDeepLinkService->post($body);
        if($result['status_code']==200){
            $shortLink=$result['response']['shortLink'];
            $insert_item['product_code']=$product_code;
            $insert_item['deep_link']=$shortLink;

            if($saveData->create($insert_item)){
                return ['short_link' =>"$shortLink", 'status_code' => $result['status_code'],'ms'=>"successfuly created"];
            }else{
                return ['short_link' =>"", 'status_code' => 500,'ms'=>"something is wrong"];
            }

        }else{
            return ['short_link' =>"", 'status_code' => 500,'ms'=>"something is wrong"];
        }



    }

}

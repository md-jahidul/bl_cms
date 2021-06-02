<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:56 PM
 */

namespace App\Services;

use App\Repositories\AboutPageRepository;
use App\Repositories\PrizeRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DynamicDeeplinkService
{
    use CrudTrait;

    /**
     * @var FirebaseDeepLinkService
     */
    private $firebaseDeepLinkService;

    /**
     * FirebaseDeepLinkService constructor.
     * @param FirebaseDeepLinkService $firebaseDeepLinkService
     */
    public function __construct(
        FirebaseDeepLinkService $firebaseDeepLinkService
    ) {
        $this->firebaseDeepLinkService = $firebaseDeepLinkService;
//        $this->setActionRepository($aboutPageRepository);
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function generateDeeplink($sectionType, $request)
    {
        $category = $request->category;
        $subCategory = $request->sub_category;

        if ($category && $subCategory) {
            $endPointURL = "$sectionType/$category/$subCategory";
        } else {
            $endPointURL = "$sectionType/$category";
        }
//        dd($request->all());
//
//        $product = MyBlProduct::where('product_code', $product_code)->first();
//        if (!$product) {
//            throw new NotFoundHttpException();
//        }
        $body = [
            "dynamicLinkInfo" => [
                "domainUriPrefix" => env('DOMAINURIPREFIX'),
                "link" => "https://banglalink.net/$endPointURL",
                "androidInfo" => [
                    "androidPackageName" => "com.arena.banglalinkmela.app"
                ],
                "iosInfo" => [
                    "iosBundleId" => "com.Banglalink.My-Banglalink"
                ]
            ]
        ];

//        $saveData = new ProductDeepLink();
        $insert_item = array();
        $result = $this->firebaseDeepLinkService->post($body);
//        dd($result);
        if ($result['status_code'] == 200) {
            $shortLink = $result['response']['shortLink'];
//            $insert_item['product_code'] = $product_code;
//            $insert_item['deep_link'] = $shortLink;

            return ['short_link' => "$shortLink", 'status_code' => $result['status_code'], 'ms' => "successfuly created"];

//            if ($saveData->create($insert_item)) {
//                return ['short_link' => "$shortLink", 'status_code' => $result['status_code'], 'ms' => "successfuly created"];
//            } else {
//                return ['short_link' => "", 'status_code' => 500, 'ms' => "something is wrong"];
//            }

        } else {
            return ['short_link' => "", 'status_code' => 500, 'ms' => "something is wrong"];
        }

//        return $this->aboutPageRepository->findDetail($slug);
    }
}

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
        $result = $this->firebaseDeepLinkService->post($body);
        if ($result['status_code'] == 200) {
            $shortLink = $result['response']['shortLink'];
            return [
                'short_link' => "$shortLink",
                'status_code' => $result['status_code'],
                'ms' => "Successfully created"
            ];
        } else {
            return ['short_link' => "", 'status_code' => 500, 'ms' => "something is wrong"];
        }
    }
}

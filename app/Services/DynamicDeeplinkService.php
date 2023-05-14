<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:56 PM
 */

namespace App\Services;

use App\Repositories\AboutPageRepository;
use App\Repositories\MyblDynamicDeeplinkRepository;
use App\Repositories\PrizeRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DynamicDeeplinkService
{
    /**
     * @var FirebaseDeepLinkService
     */
    private $firebaseDeepLinkService;
    /**
     * @var MyblDynamicDeeplinkRepository
     */
    private $dynamicDeeplinkRepository;

    /**
     * FirebaseDeepLinkService constructor.
     * @param FirebaseDeepLinkService $firebaseDeepLinkService
     */
    public function __construct(
        FirebaseDeepLinkService $firebaseDeepLinkService,
        MyblDynamicDeeplinkRepository $dynamicDeeplinkRepository
    ) {
        $this->firebaseDeepLinkService = $firebaseDeepLinkService;
        $this->dynamicDeeplinkRepository = $dynamicDeeplinkRepository;
    }

    /**
     * @param $dynamicLinks
     * @return Collection
     */
    public function prepareDeeplinkData($dynamicLinks): Collection
    {
        return collect($dynamicLinks)->map(function ($data) {
            if (isset($data->referenceable->name)) {
                $data['reference_name'] = $data->referenceable->name;
            } elseif (isset($data->referenceable->name_en)) {
                $data['reference_name'] = $data->referenceable->name_en;
            } elseif (isset($data->referenceable->title)) {
                $data['reference_name'] = $data->referenceable->title;
            } elseif (isset($data->referenceable->title_en)) {
                $data['reference_name'] = $data->referenceable->title_en;
            }
            unset($data->referenceable);
            return $data;
        });
    }

    public function analyticData()
    {
        $dynamicLinks = $this->dynamicDeeplinkRepository->getAnalyticData();
        return $this->prepareDeeplinkData($dynamicLinks);
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function generateDeeplink($sectionType, $moduleData, $request)
    {
        $category = $request->category;
        $subCategory = $request->sub_category;

        if ($sectionType == "others") {
            $endPointURL = $category;
        } elseif ($moduleData->category_name == "content") {
            if ($sectionType == 'all'){
                $endPointURL = "$category/$sectionType";
            } else {
                $endPointURL = "$request->category";
            }

        } elseif ($moduleData->category_name == "commerce") {
            if($moduleData->slug == 'commerce') {
                $endPointURL = "commerce/all";
            } else {
                $endPointURL = "$moduleData->slug";
            }

        } elseif ($moduleData->category_name == "ott") {
            $endPointURL = "$moduleData->slug";
        } elseif ($category && $subCategory) {
            $endPointURL = "$sectionType/$category/$subCategory";
        } else {
            $endPointURL = "$sectionType/$category";
        }

        $body = [
            "dynamicLinkInfo" => [
                "domainUriPrefix" => env('DOMAINURIPREFIX'),
                "link" => env('DEEP_LINK_BASE_URL', 'https://www.banglalink.net/cms/') . "$endPointURL",
                "androidInfo" => [
                    "androidPackageName" => env('ANDROID_PACKAGE_NAME', 'com.arena.banglalinkmela.app')
                ],
                "iosInfo" => [
                    "iosBundleId" => "com.Banglalink.My-Banglalink"
                ]
            ]
        ];

        $result = $this->firebaseDeepLinkService->post($body);
        if ($result['status_code'] == 200) {
            $shortLink = $result['response']['shortLink'];

            // Store Deep-link Info
            $data = [
                'link' => $shortLink,
                'deep_link' => $body['dynamicLinkInfo']['link']
            ];
            $moduleData->dynamicLinks()->create($data);
            return [
                'short_link' => $shortLink,
                'status_code' => $result['status_code'],
                'ms' => "Successfully created"
            ];
        } else {
            return ['short_link' => "", 'status_code' => 500, 'ms' => "something is wrong"];
        }
    }
}

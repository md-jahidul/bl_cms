<?php

namespace App\Services\Assetlite;

//use App\Repositories\AppServiceProductegoryRepository;

use App\Repositories\AlReferralInfoRepository;
use App\Repositories\AppServiceProductRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AppServiceProductService
{
    use CrudTrait;
    use FileTrait;

    const APP = 1;
    const VAS = 2;

    /**
     * @var $appServiceProductRepository
     */
    protected $appServiceProductRepository;
    /**
     * @var AlReferralInfoRepository
     */
    private $alReferralInfoRepository;

    /**
     * AppServiceProductService constructor.
     * @param AppServiceProductRepository $appServiceProductRepository
     * @param AlReferralInfoRepository $alReferralInfoRepository
     */
    public function __construct(
        AppServiceProductRepository $appServiceProductRepository,
        AlReferralInfoRepository $alReferralInfoRepository
    ) {
        $this->appServiceProductRepository = $appServiceProductRepository;
        $this->alReferralInfoRepository = $alReferralInfoRepository;
        $this->setActionRepository($appServiceProductRepository);
    }

    public function productList()
    {
        return $this->findAll('', [
            'appServiceTab' => function ($q) {
                $q->select('id', 'name_en', 'alias');
            },
            'appServiceCat' => function ($q) {
                $q->select('id', 'title_en');
            }
        ], ['column' => 'created_at', 'direction' => 'DESC']);
    }

    /**
     * @param $data
     * @return Response
     */
    public function storeAppServiceProduct($data)
    {
        $referralInfo = isset($data['referral']) ? $data['referral'] : null;
        if (request()->hasFile('product_img_url')) {
            $data['product_img_url'] = $this->upload($data['product_img_url'], 'assetlite/images/app-service/product');
        }

        if (request()->hasFile('details_image_url')) {
            $data['details_image_url'] = $this->upload($data['details_image_url'], 'assetlite/images/app-service/product');
        }

        $data['created_by'] = Auth::id();
        $data['is_images'] = isset($data['is_images']) ? 1 : 0;
        unset($data['referral']);

        $app = $this->save($data);

        // Referral Info Store
        if ($referralInfo) {
            $referralInfo['app_id'] = $app->id;
            $this->alReferralInfoRepository->save($referralInfo);
        }
        return new Response('App Service Category added successfully');
    }

    /**
     * @param $data
     * @param $id
     * @return ResponseFactory|Response
     */
    public function updateAppServiceProduct($data, $id)
    {
        $referralData = isset($data['referral']) ? $data['referral'] : null;
        $appServiceProduct = $this->findOne($id);
        if (request()->hasFile('product_img_url')) {
            $data['product_img_url'] = $this->upload($data['product_img_url'], 'assetlite/images/app-service/product');
            $this->deleteFile($appServiceProduct->product_img_url);
        }

        if (request()->hasFile('details_image_url')) {
            $data['details_image_url'] = $this->upload($data['details_image_url'], 'assetlite/images/app-service/product');
            $this->deleteFile($appServiceProduct->details_image_url);
        }
        $data['is_images'] = isset($data['is_images']) ? 1 : 0;
        $data['can_active'] = (isset($data['can_active']) ? 1 : 0);
        $data['show_in_vas'] = (isset($data['show_in_vas']) ? 1 : 0);
        $data['show_ussd'] = (isset($data['show_ussd']) ? 1 : 0);
        $data['show_subscribe'] = (isset($data['show_subscribe']) ? 1 : 0);
        $data['updated_by'] = Auth::id();
        unset($data['referral']);
        $appServiceProduct->update($data);

        if ($referralData) {
            $referralInfo = $this->alReferralInfoRepository->findOneByProperties(['app_id' => $id]);
            if ($referralInfo) {
                $referralInfo->update($referralData);
            } else {
                $referralData['app_id'] = $id;
                $this->alReferralInfoRepository->save($referralData);
            }
        }

        return Response('App Service Category updated successfully');
    }

    /**
     * @param $id
     * @return ResponseFactory|Response
     * @throws Exception
     */
    public function deleteAppServiceProduct($id)
    {
        $appServiceProduct = $this->findOne($id);
        $this->deleteFile($appServiceProduct->product_img_url);
        $appServiceProduct->delete();
        return Response('App Service Product deleted successfully !');
    }

    public function appServiceRelatedProduct($tab_type, $product_id)
    {
        return $this->appServiceProductRepository->appServiceProduct($tab_type, $product_id);
    }

    public function detailsProduct($id)
    {
        return $this->appServiceProductRepository->findOne(['id' => $id]);
    }
}

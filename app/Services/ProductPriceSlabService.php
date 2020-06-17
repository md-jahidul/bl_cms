<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 13/02/2020
 */

namespace App\Services;

use App\Repositories\ProductPriceSlabRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Http\JsonResponse;


class ProductPriceSlabService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var ProductPriceSlabRepository
     */
    private $productPriceSlabRepository;

    /**
     * ProductPriceSlabRepository constructor.
     * @param ProductPriceSlabRepository $productPriceSlabRepository
     */
    public function __construct(ProductPriceSlabRepository $productPriceSlabRepository)
    {
        $this->productPriceSlabRepository = $productPriceSlabRepository;
        $this->setActionRepository($productPriceSlabRepository);
    }

    /**
     * Get Internet package
     * @param $request
     * @return array
     */
    public function getPriceSlab($request)
    {
        return $this->productPriceSlabRepository->getPriceSlabList($request);
    }


    /**
     * @param $request
     * @return array
     */
    public function updatePriceSlab($request, $id)
    {
        try {
            $priceSlab = $this->findOne($id);
            $data = $request->all();
            $data['product_code'] = str_replace(' ', '', strtoupper($request->product_code));
            $priceSlab->update($data);
            $response = [
                'success' => 1,
            ];
            return $response;
        } catch (\Exception $e) {
            $response = [
                'success' => 0,
                'message' => $e
            ];
            return $response;
        }
    }

    /**
     * Upload/Save excel file
     * @param $request
     * @return JsonResponse
     */
    public function saveExcel($request)
    {
        return $this->productPriceSlabRepository->saveExcelFile($request);
    }

    /**
     * change showing status
     * @return JsonResponse
     */
    public function statusChange($id)
    {
        return $this->productPriceSlabRepository->statusChange($id);
    }

    /**
     * Delete Internet package
     * @param $operatorId
     * @return JsonResponse
     */
    public function deletePriceSlab($operatorId)
    {
        return $this->productPriceSlabRepository->deletePriceSlab($operatorId);
    }

}

<?php

namespace App\Services;

use App\Models\ProductCore;
use App\Repositories\ProductCoreRepository;
use App\Repositories\ProductDetailRepository;
use App\Repositories\ProductRepository;
use App\Traits\CrudTrait;
use Box\Spout\Common\Type;
use Box\Spout\Reader\Common\Creator\ReaderFactory;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class ProductCoreService
{
    use CrudTrait;

    /**
     * @var $partnerOfferRepository
     */
    protected $productCoreRepository;
    /**
     * @var array
     */
    protected $config;

    /**
     * ProductCoreService constructor.
     * @param ProductCoreRepository $productCoreRepository
     */
    public function __construct(ProductCoreRepository $productCoreRepository)
    {
        $this->productCoreRepository = $productCoreRepository;
        $this->setActionRepository($productCoreRepository);
        $this->config = [
            'sim_type' => 0,
            'content_type' => 1,
            'family_name' => 2,
            'product_code' => 3,
            'name' => 4,
            'commercial_name_en' => 5,
            'commercial_name_bn' => 6,
            'short_description' => 7,
            'activation_ussd' => 8,
            'balance_check_ussd' => 9,
            'offer_id' => 10,
            'sms_volume' => 11,
            'minute_volume' => 12,
            'data_volume' => 13,
            'internet_volume_mb' => 13,
            'data_volume_unit' => 14,
            'validity' => 15,
            'validity_unit' => 16,
            'mrp_price' => 17,
            'price' => 18,
            'vat' => 19,
            'show_in_app' => 20,
            'is_amar_offer' => 21,
            'is_auto_renewable' => 22,
            'is_recharge_offer' => 23,
            'is_gift_offer' => 24,
            'is_social_pack' => 25,
        ];
    }

    /**
     * @param $typeId
     * @return string
     */
    public function getType($typeId)
    {
        switch ($typeId) {
            case "1":
                $offerId = "data";
                break;
            case '2':
                $offerId = "voice";
                break;
            case '3':
                $offerId = "mix";
                break;
            default:
        }
        return $offerId;
    }

    /**
     * @param $data
     * @return Response
     */
    public function storeProductCore($data, $simId)
    {
        $productCode = $this->productCoreRepository
            ->findByProperties(['product_code' => $data['product_code']])
            ->first();
        if (empty($productCode)) {
            $data['name'] = $data['name_en'];
            $data['product_code'] = str_replace(' ', '', strtoupper($data['product_code']));
            $data['mrp_price'] = $data['price'] + $data['vat'];
            $data['is_recharge_offer'] = $data['is_recharge'];
            $data['commercial_name_en'] = $data['name_en'];
            $data['commercial_name_bn'] = $data['name_bn'];
            $data['content_type'] = $this->getType($data['offer_category_id']);
            $data['sim_type'] = $simId;
            $this->save($data);
        }
    }

    public function findProductCore($id)
    {
        return $this->productCoreRepository->findWithProduct($id);
    }

    public function updateProductCore($data, $id)
    {
        $product = $this->productCoreRepository->findOneProductCore($id);
        $product->update($data);
    }

    public function insertBatch($data)
    {
        ProductCore::insert($data);
    }

    public function mapDataFromExcel($excel_path)
    {
        try {
            $reader = ReaderFactory::createFromType(Type::XLSX); // for XLSX files
            $file_path = $excel_path;
            $reader->open($file_path);
            $insert_data = [];
            foreach ($reader->getSheetIterator() as $sheet) {
                $row_number = 1;
                foreach ($sheet->getRowIterator() as $row) {
                    $data = [];
                    if ($row_number != 1) {
                        $cells = $row->getCells();
                        foreach ($this->config as $field => $index) {
                            switch ($field) {
                                case "family_name":
                                case "content_type":
                                    $data [$field] = ($cells [$index]->getValue() != '') ?
                                        strtolower($cells [$index]->getValue()) : null;
                                    break;
                                case "sim_type":
                                    $type = strtolower($cells [$index]->getValue());
                                    if ($type == 'prepaid') {
                                        $sim_type = 1;
                                    } elseif ($type == 'postpaid') {
                                        $sim_type = 2;
                                    } elseif ($type == 'propaid') {
                                        $sim_type = 3;
                                    } else {
                                        $sim_type = null;
                                    }
                                    $data [$field] = $sim_type;
                                    break;
                                case "is_amar_offer":
                                case "show_in_app":
                                    $type = strtolower($cells [$index]->getValue());
                                    if ($type == 'yes') {
                                        $flag = 1;
                                    } elseif ($type == 'no') {
                                        $flag = 0;
                                    } else {
                                        break;
                                    }
                                    $data [$field] = $flag;
                                    break;
                                case "is_auto_renewable":
                                case "is_recharge_offer":
                                case "is_gift_offer":
                                case "is_social_pack":
                                    $value = ($cells [$index]->getValue() != '') ?
                                        $cells [$index]->getValue() : 0;
                                    $data [$field] = $value;
                                    break;
                                case "internet_volume_mb":
                                    $data_volume = $cells [$index]->getValue();

                                    if ($data_volume == '') {
                                        $data_volume = 0;
                                    }
                                    $data_unit = $cells [$index + 1]->getValue();
                                    if ($data_unit == 'GB') {
                                        $volume = $data_volume * 1024;
                                        $data [$field] = $volume;
                                    } else {
                                        $data [$field] = $data_volume;
                                    }
                                    break;
                                case "data_volume":
                                    $data_volume = $cells [$index]->getValue();

                                    if ($data_volume == '') {
                                        $data_volume = 0;
                                    }
                                    $data [$field] = $data_volume;
                                    break;
                                case "sms_volume":
                                case "minute_volume":
                                    $volume = $cells [$index]->getValue();
                                    if ($volume == '') {
                                        $volume = 0;
                                    }
                                    $data [$field] = $volume;
                                    break;
                                case "internet_volume_unit":
                                    $data_volume_unit = $cells [$index]->getValue();
                                    $data [$field] = $data_volume_unit;
                                    break;

                                default:
                                    $data [$field] = ($cells [$index]->getValue() != '') ?
                                        $cells [$index]->getValue() : null;
                            }
                        }
                        try {
                            $product_code = $data['product_code'];
                            unset($data['product_code']);
                            ProductCore::updateOrCreate([
                                'product_code' => $product_code
                            ], $data);

                        } catch (\Exception $e) {
                            dd($e->getMessage());
                            continue;
                        }
                    }
                    $row_number++;
                }
            }
            $reader->close();
            return true;
        } catch (\Exception $e) {
            dd($e->getMessage());
            Log::error('Product Entry Error' . $e->getMessage());
        }
    }


    /*
     *  product search by code
     *  return products that contains the keyword in product code
     */
    public function searchProductCodes($keyword)
    {
        return ProductCore::where('product_code', 'like', '%' . $keyword . '%')->get();
    }

    public function getProductDetails($product_code)
    {
        return ProductCore::where('product_code', $product_code)->first();
    }

}

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
            'code' => 3,
            'name' => 4,
            'commercial_name_en' => 5,
            'commercial_name_bn' => 6,
            'short_description' => 7,
            'activation_ussd' => 8,
            'balance_check_ussd' => 9,
            'offer_id' => 10,
            'sms_volume' => 11,
            'minute_volume' => 12,
            'internet_volume_mb' => 13,
            'internet_volume_unit' => 14,
            'validity' => 15,
            'validity_unit' => 16,
            'mrp_price' => 17,
            'price' => 18,
            'vat' => 19,
            'show_in_app' => 20,
            'is_amar_offer' => 21,
            'is_auto_renewable' => 22,
        ];
    }

    /**
     * @param $data
     * @return Response
     */
    public function storeProductCore($data)
    {
        return $this->productCoreRepository->insertProductCore($data);
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
                                case "internet_volume_mb":
                                    $data_volume = $cells [$index]->getValue();
                                    $data_unit   = $cells [$index + 1]->getValue();
                                    if ($data_unit == 'GB') {
                                        $volume = $data_volume * 1024;
                                        $data [$field] = $volume;
                                    } else {
                                        $data [$field] = $data_volume;
                                    }
                                    break;
                                case "internet_volume_unit":
                                    break;

                                default:
                                    $data [$field] = ($cells [$index]->getValue() != '') ?
                                        $cells [$index]->getValue() : null;
                            }
                        }

                        $insert_data [] = $data;
                    }
                    $row_number++;
                }
            }
            $reader->close();

            $this->insertBatch($insert_data);
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
        return ProductCore::where('code', 'like', '%' . $keyword . '%')->get();
    }

    public function getProductDetails($product_code)
    {
        return ProductCore::where('code', $product_code)->first();
    }
}

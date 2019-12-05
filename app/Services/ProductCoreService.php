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
            'voice_volume' => 12,
            'data_volume' => 13,
            'data_volume_unit' => 14,
            'validity' => 15,
            'validity_unit' => 16,
            'mrp_price' => 17,
            'price' => 18,
            'tax' => 19,
            'show_in_app' => 20,
            'is_amar_offer' => 21,
            'is_auto_renewable' => 22,
        ];
    }

    /**
     * @param $data
     * @return Response
     */
    public function storeProductCore($data, $simId)
    {
        return $this->productCoreRepository->insertProductCore($data, $simId);
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
                            $data [$field] = ($cells [$index]->getValue() != '') ? $cells [$index]->getValue() : null;
                        }

                        $insert_data [] = $data;
                    }
                    $row_number++;
                }
            }
            $reader->close();

            $this->insertBatch($insert_data);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}

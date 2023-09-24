<?php

namespace App\Services\MyPlan;

use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Box\Spout\Common\Type;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Box\Spout\Common\Entity\Style\Color;
use App\Repositories\AboutPageRepository;
use App\Repositories\MyPlanProductRepository;
use Box\Spout\Reader\Common\Creator\ReaderFactory;
use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;

class MyPlanProductService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var MyPlanProductRepository
     */
    protected $myBlPlanProductRepository;

    /**
     * AboutPageService constructor.
     * @param MyPlanProductRepository $myBlPlanProductRepository
     */
    public function __construct(MyPlanProductRepository $myBlPlanProductRepository)
    {
        $this->myBlPlanProductRepository = $myBlPlanProductRepository;
        $this->setActionRepository($myBlPlanProductRepository);
    }

    public function findByCode($productCode)
    {
        return $this->myBlPlanProductRepository->findOneByProperties(['product_code' => $productCode], ['product_code']);
    }

    public function uploadProductExcel($excel_path)
    {
        $config = config('productMapping.my_plan.columns');
        $reader = ReaderFactory::createFromType(Type::XLSX); // for XLSX files
        $file_path = $excel_path;
        $reader->open($file_path);

        foreach ($reader->getSheetIterator() as $sheet) {
            $row_number = 1;
            foreach ($sheet->getRowIterator() as $row) {
                $core_data = [];

                if ($row_number != 1) {
                    $cells = $row->getCells();
                    foreach ($config as $field => $index) {
                        switch ($field) {
                            case "sim_type":
                            case "display_sd_vat_tax_en":
                            case "display_sd_vat_tax_bn":
                            case "validity":
                            case "product_code":
                            case "market_price":
                            case "discount_percentage":
                            case "discount_price":
                            case "savings_amount":
                                $core_data[$field] = $cells[$index]->getValue();
                                break;
                            case "content_type":
                            case "tag":
                            case "data_volume_unit":
                            case "validity_unit":
                                $core_data[$field] = strtolower($cells[$index]->getValue()) ?: null;
                                break;
                            case "recharge_code":
                            case "renew_product_code":
                                $core_data[$field] = $cells[$index]->getValue() ?: null;
                                break;
                            case "minute_volume":
                            case "data_volume":
                            case "sms_volume":
                            case "points":
                                $core_data[$field] = $cells[$index]->getValue() ?: 0;
                                break;
                            case "is_active":
                                $status = strtolower($cells[$index]->getValue()) ?: 'yes';
                                if ($status == 'yes') {
                                    $core_data[$field] = 1;
                                } else {
                                    $core_data[$field] = 0;
                                }
                                break;
                            default:
                                $core_data[$field] = ($cells[$index]->getValue() != '') ?
                                    $cells[$index]->getValue() : null;
                        }
                    }

                    $this->myBlPlanProductRepository->updateOrCreateProduct($core_data);
                }

                $row_number++;
            }
        }

        $reader->close();

        return true;
    }

    public function downloadPlanProducts()
    {
        $products = $this->findAll(null, null, ['column' => 'id', 'direction' => 'desc']);
        $writer = WriterEntityFactory::createXLSXWriter();
        $writer->openToBrowser('my-plan-active-products-' . date('Y-m-d') . '.xlsx');

        // header Style
        $header_style = (new StyleBuilder())
            ->setFontBold()
            ->setFontSize(11)
            ->setBackgroundColor(Color::rgb(245, 245, 240))
            ->build();

        $data_style = (new StyleBuilder())
            ->setFontSize(9)
            ->build();

        $header = config('productMapping.mybl_plan.columns');
        $headers = array_map(function ($val) {
            return str_replace('_', ' ', ucwords($val));
        }, array_keys($header));

        $row = WriterEntityFactory::createRowFromArray(array_values($headers), $header_style);
        $writer->addRow($row);

        $problem = [];
        foreach ($products as $product) {
            if (!empty($product)) {
                $product = $product->toArray();
                unset(
                    $product['id'],
                    $product['created_at'],
                    $product['updated_at'],
                    $product['deleted_at'],
                    $product['is_default']
                );
                $product['is_active'] = ($product['is_active'] == 1) ? 'Yes' : 'No';
                $row = WriterEntityFactory::createRowFromArray($product, $data_style);

                $writer->addRow($row);
            } else {
                $problem[] = $product;
            }
        }
        if (count($problem)) {
            Log::info(json_encode($problem));
        }
        $writer->close();
    }

    /**
     * @param $id
     * @return ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteProduct($id)
    {
        $product = $this->findOne($id);
        $product->delete();
        return Response('Product delete successfully');
    }
}

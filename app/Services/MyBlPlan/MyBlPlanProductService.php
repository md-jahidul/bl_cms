<?php

namespace App\Services\MyBlPlan;

use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Box\Spout\Common\Type;
use Illuminate\Support\Facades\Log;
use Box\Spout\Common\Entity\Style\Color;
use App\Repositories\AboutPageRepository;
use App\Repositories\MyBlPlanProductRepository;
use Box\Spout\Reader\Common\Creator\ReaderFactory;
use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;

class MyBlPlanProductService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var MyBlPlanProductRepository
     */
    protected $myBlPlanProductRepository;

    /**
     * AboutPageService constructor.
     * @param MyBlPlanProductRepository $myBlPlanProductRepository
     */
    public function __construct(MyBlPlanProductRepository $myBlPlanProductRepository)
    {
        $this->myBlPlanProductRepository = $myBlPlanProductRepository;
        $this->setActionRepository($myBlPlanProductRepository);
    }

    public function uploadProductExcel($excel_path)
    {
        $config = config('productMapping.mybl_plan.columns');
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
                                $core_data[$field] = strtolower($cells[$index]->getValue());
                                break;
                            case "content_type":
                                $core_data[$field] = strtolower($cells[$index]->getValue()) ?: null;
                                break;
                            case "product_code":
                                $core_data[$field] = $cells[$index]->getValue();
                                break;
                            case "renew_product_code":
                                $core_data[$field] = $cells[$index]->getValue() ?: null;
                                break;
                            case "recharge_code":
                                $core_data[$field] = $cells[$index]->getValue() ?: null;
                                break;
                            case "sms_volume":
                                $core_data[$field] = $cells[$index]->getValue() ?: 0;
                                break;
                            case "minute_volume":
                                $core_data[$field] = $cells[$index]->getValue() ?: 0;
                                break;
                            case "data_volume":
                                $data_vol = $cells[$index]->getValue() ?: 0;
                                $data_unit = strtolower($cells[$index + 1]->getValue());

                                if ($data_unit == 'gb') {
                                    $data_vol = $data_vol * 1024;
                                }

                                $core_data[$field] = $data_vol;
                                break;
                            case "data_volume_unit":
                                $core_data[$field] = strtolower($cells[$index]->getValue());
                                break;
                            case "validity":
                                $core_data[$field] = $cells[$index]->getValue();
                                break;
                            case "validity_unit":
                                $core_data[$field] = strtolower($cells[$index]->getValue());
                                break;
                            case "tag":
                                $core_data[$field] = strtolower($cells[$index]->getValue()) ?: null;
                                break;
                            case "display_sd_vat_tax_en":
                                $core_data[$field] = strtolower($cells[$index]->getValue()) ?: null;
                                break;
                            case "display_sd_vat_tax_bn":
                                $core_data[$field] = strtolower($cells[$index]->getValue()) ?: null;
                                break;
                            case "points":
                                $core_data[$field] = $cells[$index]->getValue() ?: null;
                                break;
                            case "market_price":
                                $core_data[$field] = $cells[$index]->getValue() ?: null;
                                break;
                            case "discount_price":
                                $core_data[$field] = $cells[$index]->getValue() ?: null;
                                break;
                            case "discount_percentage":
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

        $writer->openToBrowser('mybl-plan-active-products-' . date('Y-m-d') . '.xlsx');

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
                    $product['deleted_at']
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
}

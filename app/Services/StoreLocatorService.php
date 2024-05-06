<?php

namespace App\Services;

use App\Models\ProductCore;
use App\Models\StoreLocator;
use App\Repositories\ProductCoreRepository;
use App\Repositories\ProductDetailRepository;
use App\Repositories\ProductRepository;
use App\Repositories\StoreLocatorRepository;
use App\Traits\CrudTrait;
use Box\Spout\Common\Type;
use Box\Spout\Reader\Common\Creator\ReaderFactory;
use Carbon\Carbon;
use DateTime;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class StoreLocatorService
{
    /**
     * @var array
     */
    protected $config;
    /**
     * @var StoreLocatorRepository
     */
    private $storeLocatorRepository;

    public function __construct(StoreLocatorRepository $storeLocatorRepository)
    {
        $this->storeLocatorRepository = $storeLocatorRepository;
        $this->config = [
            'district' => 2,
            'thana' => 3,
            'cc_code' => 4,
            'cc_name' => 5,
            'longitude' => 6,
            'latitude' => 7,
            'opening_time' => 8,
            'closing_time' => 9,
            'holiday' => 10,
            'half_holiday' => 11,
            'half_holiday_opening_time' => 12,
            'half_holiday_closing_time' => 13,
            'address' => 14,
            'additional_info' => 15
        ];
    }

    public function validateDate($date, $format = 'Y-m-d H:i:s')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
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
                                case "opening_time":
                                case "closing_time":
                                case "half_holiday_opening_time":
                                case "half_holiday_closing_time":
                                    $value = $cells [$index]->getValue();
                                    if ($value instanceof DateTime) {
                                        $data [$field]  = $value->format('h:00:00 a');
                                    } else {
                                        $data [$field]  = $value;
                                    }
                                    break;
                                default:
                                    $data [$field] = ($cells [$index]->getValue() != '') ?
                                    $cells [$index]->getValue() : null;
                            }
                        }
                        try {
                            $cc_code = $data['cc_code'];
                            unset($data['cc_code']);
                            StoreLocator::updateOrCreate([
                                'cc_code' => $cc_code
                            ], $data);
                        } catch (\Exception $e) {
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
            Log::error('Store Locator Entry Error' . $e->getMessage());
        }
    }

    public function deleteAllData()
    {
        try {
            $this->storeLocatorRepository->deleteStoreLocator();
            return [
                'success' => true
            ];
        }catch (\Exception $exception){
            return [
                'success' => false,
                'message' => $exception->getMessage()
            ];
        }
    }
}

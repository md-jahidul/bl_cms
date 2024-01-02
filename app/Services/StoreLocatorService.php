<?php

namespace App\Services;

use App\Models\ProductCore;
use App\Models\StoreLocator;
use App\Repositories\ProductCoreRepository;
use App\Repositories\ProductDetailRepository;
use App\Repositories\ProductRepository;
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

    public function __construct()
    {
        $this->config = [
            'district' => 1,
            'thana' => 2,
            'cc_code' => 3,
            'cc_name' => 4,
            'longitude' => 5,
            'latitude' => 6,
            'opening_time' => 7,
            'closing_time' => 8,
            'holiday' => 9,
            'half_holiday' => 10,
            'half_holiday_opening_time' => 11,
            'half_holiday_closing_time' => 12,
            'address' => 13,
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
}

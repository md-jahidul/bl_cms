<?php

namespace App\Services;

use App\Http\Helpers;
use App\Repositories\AboutUsRepository;
use App\Repositories\FreeProductPurchaseReportRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class FreeProductPurchaseReportService
{
    use CrudTrait;

    /**
     * @var FreeProductPurchaseReportRepository
     */
    private $purchaseReportRepository;

    /**
     * FreeProductPurchaseReportService constructor.
     * @param FreeProductPurchaseReportRepository $purchaseReportRepository
     */
    public function __construct(FreeProductPurchaseReportRepository $purchaseReportRepository)
    {
        $this->purchaseReportRepository = $purchaseReportRepository;
        $this->setActionRepository($purchaseReportRepository);
    }

    /**
     * @param $campaign
     * @param $column
     * @param $colValue
     * @return mixed
     */
    public function purchaseStatusCount($purchaseCode, $column, $colValue)
    {
        return collect($purchaseCode->purchaseMsisdns)->sum(function ($data) use ($column, $colValue) {
            if ($data->{$column} == $colValue) {
                return true;
            }
            return false;
        });
    }

    /**
     * @param $date
     * @return array
     */
    public function analyticsData($date)
    {
        $purchaseCodes = $this->purchaseReportRepository->purchaseCodeWithMsisdn($date);
        foreach ($purchaseCodes as $key => $purchaseCode) {
            $total_success = $this->purchaseStatusCount($purchaseCode, 'status', 'buy_success');
            $total_failed = $this->purchaseStatusCount($purchaseCode, 'status', 'buy_failure');

            $purchaseCodes[$key]['total_success'] = $total_success;
            $purchaseCodes[$key]['total_failed'] = $total_failed;
        }
        return $purchaseCodes;
    }

    public function msisdnPurchaseDetails($request, $id)
    {
        return $this->purchaseReportRepository->msisdnInfo($request, $id);
    }
}

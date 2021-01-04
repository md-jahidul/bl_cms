<?php

namespace App\Services;

use App\Enums\PurchaseLog;
use App\RecurringSchedule;
use App\Repositories\MyBlAppLaunchPopupRepository;
use App\Repositories\PopupProductPurchaseDetailRepository;
use App\Repositories\RecurringScheduleRepository;
use App\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use phpDocumentor\Reflection\Types\Collection;

class AppLaunchPopupService
{
    use CrudTrait;

    /**
     * @var MyBlAppLaunchPopupRepository
     */
    private $appLaunchPopupRepository;
    /**
     * @var RecurringScheduleHourService
     */
    private $recurringScheduleHourService;
    /**
     * @var RecurringScheduleRepository
     */
    private $recurringScheduleRepository;
    /**
     * @var PopupProductPurchaseDetailRepository
     */
    private $popupProductPurchaseDetailRepository;

    /**
     * AppLaunchPopupService constructor.
     * @param MyBlAppLaunchPopupRepository $appLaunchPopupRepository
     * @param RecurringScheduleHourService $recurringScheduleHourService
     * @param RecurringScheduleRepository $recurringScheduleRepository
     * @param PopupProductPurchaseDetailRepository $popupProductPurchaseDetailRepository
     */
    public function __construct(
        MyBlAppLaunchPopupRepository $appLaunchPopupRepository,
        RecurringScheduleHourService $recurringScheduleHourService,
        RecurringScheduleRepository $recurringScheduleRepository,
        PopupProductPurchaseDetailRepository $popupProductPurchaseDetailRepository
    ) {
        $this->appLaunchPopupRepository = $appLaunchPopupRepository;
        $this->recurringScheduleHourService = $recurringScheduleHourService;
        $this->setActionRepository($appLaunchPopupRepository);
        $this->recurringScheduleRepository = $recurringScheduleRepository;
        $this->popupProductPurchaseDetailRepository = $popupProductPurchaseDetailRepository;
    }

    /**
     * @param array $data
     * @param null $id
     * @return bool|\Illuminate\Database\Eloquent\Model|\Illuminate\Http\RedirectResponse
     */
    public function storeOrUpdate(array $data, $id = null)
    {
        try {
            return DB::transaction(function () use ($data, $id) {
                $type = $data['type'];
                if ($type == 'image' || $type == 'purchase') {
                    if (isset($data['content_data'])) {
                        // upload the image
                        $file = $data['content_data'];
                        $path = $file->storeAs(
                            'app-launch-popup/images',
                            strtotime(now()) . '.' . $file->getClientOriginalExtension(),
                            'public'
                        );
                        $data['content'] = $path;
                    } elseif (!isset($data['content_data']) && is_null($id)) {
                        return redirect()->back()->with('error', 'Image is required');
                    }

                } else {
                    $data['content'] = $data['content_data'];
                }

                // start date end date
                $date_range_array = explode('-', $data['display_period']);
                $data['start_date'] = Carbon::createFromFormat('Y/m/d h:i A', trim($date_range_array[0]))
                    ->toDateTimeString();
                $data['end_date'] = Carbon::createFromFormat('Y/m/d h:i A', trim($date_range_array[1]))
                    ->toDateTimeString();

                if (is_null($id)) {
                    $data['created_by'] = auth()->id();
                    $popup = $this->save($data);
                } else {
                    $popup = $this->findOne($id);
                    $popup->update($data);
                }

                // Storing recurring schedule
                if ($data['recurring_type'] != 'none') {
                    $this->saveSchedule(
                        $data['time_ranges'],
                        $popup->id,
                        $data['weekdays'] ?? null,
                        $data['month_dates'] ?? null
                    );
                }
                return $popup;
            });

        } catch (\Exception $e) {

            Log::error('Error while saving popup notification: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * @param $timeSlots
     * @param $schedulerId
     * @param null $weekdays
     * @param null $monthDates
     */
    private function saveSchedule($timeSlots, $schedulerId, $weekdays = null, $monthDates = null)
    {
        foreach ($timeSlots as $key => $timeSlot) {
            $timeRange = explode('-', $timeSlot);
            $hourSlotData = [
                'scheduler_id' => $schedulerId,
                'feature' => 'popup',
                'start_time' => Carbon::parse($timeRange[0])->format('H:i:s'),
                'end_time' => Carbon::parse($timeRange[1])->format('H:i:s'),
                'used' => true
            ];
            $this->recurringScheduleHourService->addOrReplace($hourSlotData, $key === 0 ? true : false);
        }

        $checkSchedule = $this->recurringScheduleRepository->findBy(['schedulable_item_id' => $schedulerId]);

        $scheduleData = [
            'schedulable_item' => 'popup',
            'schedulable_item_id' => $schedulerId,
            'weekdays' => (!is_null($weekdays)) ? implode(',', $weekdays) : null,
            'month_dates' => (!is_null($monthDates)) ? implode(',', $monthDates) : null,
            'status' => true
        ];

        if (count($checkSchedule)) {
            RecurringSchedule::where('schedulable_item_id', $schedulerId)->update($scheduleData);
        } else {
            $this->recurringScheduleRepository->save($scheduleData);
        }
    }

    /**
     * @return array
     */
    public function getHourSlots()
    {
        return $this->recurringScheduleHourService->getHourSlots('popup');
    }

    /**
     * @param array $data
     * @return array|\Illuminate\Database\Eloquent\Collection
     */
    public function getFilteredReport(array $data)
    {
        $popups = $this->findBy(['status' => 1, 'type' => 'purchase'], ['purchaseLog']);
        if (isset($data['date_range'])) {
            $dateRangeArr = explode('-', $data['date_range']);
            $detailsData = $this->popupProductPurchaseDetailRepository->getCountsByActionType(
                trim($dateRangeArr[0]),
                trim($dateRangeArr[1])
            );
            foreach ($popups as $popup) {
                $purchaseLog = $popup->purchaseLog;
                if ($purchaseLog) {
                    $detailsDatum = $detailsData
                        ->where('popup_product_purchase_id', $purchaseLog->id)
                        ->flatten()
                        ->toArray();

                    $popup->purchaseLog = $this->prepareFilteredCount($purchaseLog, $detailsDatum);
                }
            }

        }

        return $popups;
    }

    /**
     * @param $purchaseLogId
     * @param array $data
     * @return mixed
     */
    public function getFilteredDetailReport($purchaseLogId, array $data)
    {
        if (isset($data['date_range'])) {
            $dateRangeArr = explode('-', $data['date_range']);
        }

        //dd($data['msisdn'], $dateRangeArr);

        return $this->popupProductPurchaseDetailRepository->getDataByPurchaseId(
            $purchaseLogId,
            $data['msisdn'] ?? null,
            trim($dateRangeArr[0]),
            trim($dateRangeArr[1])
        );

    }

    public function prepareFilteredCount($purchaseLog, $data)
    {
        if (count($data)) {
            foreach ($data as $datum) {
                switch ($datum['action_type']) {
                    case PurchaseLog::ACTION_POPUP_CANCEL:
                        $purchaseLog->total_popup_cancel = $datum['total_count'];
                        break;
                    case PurchaseLog::ACTION_POPUP_CONTINUE:
                        $purchaseLog->total_popup_continue = $datum['total_count'];
                        break;
                    case PurchaseLog::ACTION_BUY_SUCCESS:
                        $purchaseLog->total_buy = $datum['total_count'];
                        break;
                    case PurchaseLog::ACTION_CANCEL:
                        $purchaseLog->total_cancel = $datum['total_count'];
                        break;
                    case PurchaseLog::ACTION_BUY_FAILURE:
                        $purchaseLog->total_buy_attempt = $datum['total_count'];
                        break;
                }
            }
        } else {
            $purchaseLog->total_popup_cancel = 0;
            $purchaseLog->total_popup_continue = 0;
            $purchaseLog->total_buy = 0;
            $purchaseLog->total_cancel = 0;
            $purchaseLog->total_buy_attempt = 0;
        }
        return $purchaseLog;
    }

}

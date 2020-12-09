<?php

namespace App\Services;

use App\Repositories\MyBlAppLaunchPopupRepository;
use App\Repositories\RecurringScheduleRepository;
use App\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
     * AppLaunchPopupService constructor.
     * @param MyBlAppLaunchPopupRepository $appLaunchPopupRepository
     * @param RecurringScheduleHourService $recurringScheduleHourService
     * @param RecurringScheduleRepository $recurringScheduleRepository
     */
    public function __construct(
        MyBlAppLaunchPopupRepository $appLaunchPopupRepository,
        RecurringScheduleHourService $recurringScheduleHourService,
        RecurringScheduleRepository $recurringScheduleRepository
    ) {
        $this->appLaunchPopupRepository = $appLaunchPopupRepository;
        $this->recurringScheduleHourService = $recurringScheduleHourService;
        $this->setActionRepository($appLaunchPopupRepository);
        $this->recurringScheduleRepository = $recurringScheduleRepository;
    }

    /**
     * @param array $data
     * @return bool|\Illuminate\Database\Eloquent\Model|\Illuminate\Http\RedirectResponse
     */
    public function store(array $data)
    {
        try {
            return DB::transaction(function () use ($data) {
                $type = $data['type'];
                if ($type == 'image' || $type == 'purchase') {
                    if (!is_file($data['content_data'])) {
                        return redirect()->back()->with('error', 'Image is required');
                    }
                    // upload the image
                    $file = $data['content_data'];
                    $path = $file->storeAs(
                        'app-launch-popup/images',
                        strtotime(now()) . '.' . $file->getClientOriginalExtension(),
                        'public'
                    );

                    $data['content'] = $path;
                } else {
                    $data['content'] = $data['content_data'];
                }

                // Storing recurring schedule
                if ($data['recurring_type'] == 'none') {
                    // start date end date
                    $date_range_array = explode('-', $data['display_period']);
                    $data['start_date'] = Carbon::createFromFormat('Y/m/d h:i A', trim($date_range_array[0]))
                        ->toDateTimeString();
                    $data['end_date'] = Carbon::createFromFormat('Y/m/d h:i A', trim($date_range_array[1]))
                        ->toDateTimeString();
                } else {
                    $data['start_date'] = Carbon::now()->format('Y-m-d H:i:s');
                    $data['end_date'] = Carbon::parse('+24 hours')->format('Y-m-d H:i:s');
                }

                $data['created_by'] = auth()->id();
                $popup = $this->save($data);

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

        $scheduleData = [
            'schedulable_item' => 'popup',
            'schedulable_item_id' => $schedulerId,
            'weekdays' => (!is_null($weekdays)) ? implode(',', $weekdays) : null,
            'month_dates' => (!is_null($monthDates)) ? implode(',', $monthDates) : null,
            'status' => true
        ];

        $this->recurringScheduleRepository->save($scheduleData);
    }

    /**
     * @return array
     */
    public function getHourSlots()
    {
        return $this->recurringScheduleHourService->getHourSlots('popup');
    }

}

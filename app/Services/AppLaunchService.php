<?php

namespace App\Services;

use App\Http\Helpers;
use App\Repositories\RecurringScheduleHourRepository;
use App\Traits\CrudTrait;
use Carbon\Carbon;

class AppLaunchService
{
    use CrudTrait;

    /**
     * @var RecurringScheduleHourRepository
     */
    private $recurringScheduleHourRepository;

    /**
     * QuickLaunchService constructor.
     * @param RecurringScheduleHourRepository $recurringScheduleHourRepository
     */
    public function __construct(RecurringScheduleHourRepository $recurringScheduleHourRepository)
    {
        $this->recurringScheduleHourRepository = $recurringScheduleHourRepository;
    }

    /**
     * @return array
     */
    public function getHourSlots()
    {
        return $this->recurringScheduleHourRepository->findBy(['used' => 0])
            ->each(function ($item) {
                return $item->slot = Carbon::parse($item->start_time)->format("h:i A") . ' - ' .
                    Carbon::parse($item->end_time)->format("h:i A");
            })
            ->pluck('slot', 'id')
            ->toArray();
    }
}

<?php

namespace App\Services;

use App\Repositories\RecurringScheduleHourRepository;
use App\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class RecurringScheduleHourService
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
        $this->setActionRepository($recurringScheduleHourRepository);
    }

    /**
     * @return array
     */
    public function getHourSlots()
    {
        return $this->findBy(['used' => 0])
            ->each(function ($item) {
                return $item->slot = Carbon::parse($item->start_time)->format("h:i A") . ' - ' .
                    Carbon::parse($item->end_time)->format("h:i A");
            })
            ->pluck('slot', 'id')
            ->toArray();
    }

    /**
     * @param array $data
     * @return bool|\Illuminate\Database\Eloquent\Model
     */
    public function store(array $data)
    {
        try {
            $data['used'] = 0;
            return $this->save($data);
        } catch (\Exception $e) {
            Log::error('Error while saving schedule hours: ' . $e->getMessage());
            return false;
        }
    }
}

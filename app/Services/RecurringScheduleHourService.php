<?php

namespace App\Services;

use App\Models\RecurringScheduleHour;
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
     * @param string $feature
     * @return array
     */
    public function getHourSlots($feature = 'popup')
    {
        return $this->findBy(['used' => 0, 'feature' => $feature], null, ['column' => 'start_time', 'direction' => 'asc'])
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
            $data['used'] = $data['used'] ?? 0;
            return $this->save($data);
        } catch (\Exception $e) {
            Log::error('Error while saving schedule hours: ' . $e->getMessage());
            return false;
        }
    }

    public function addOrReplace(array $data, $reset = false)
    {
        if (isset($data['scheduler_id']) && $reset) {
           RecurringScheduleHour::where('scheduler_id', $data['scheduler_id'])->delete();
        }
        return $this->store($data);
    }
}

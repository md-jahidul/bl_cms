<?php

namespace App\Services;

use App\RecurringSchedule;
use App\Repositories\MyblCashBackProductRepository;
use App\Repositories\MyblCashBackRepository;
use App\Repositories\MyblOwnRechargeInventoryProductRepository;
use App\Repositories\MyblOwnRechargeInventoryRepository;
use App\Repositories\RecurringScheduleRepository;
use App\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class MyblOwnRechargeInventoryService
{
    use CrudTrait;

    private $ownRechargeInventoryRepository;
    private $ownRechargeInventoryProductRepository;
    private $recurringScheduleHourService;
    private $recurringScheduleRepository;
    private $ownRechargeWinningCappingService;

    public function __construct(
        MyblOwnRechargeInventoryRepository $ownRechargeInventoryRepository,
        MyblOwnRechargeInventoryProductRepository $ownRechargeInventoryProductRepository,
        RecurringScheduleHourService $recurringScheduleHourService,
        RecurringScheduleRepository $recurringScheduleRepository,
        OwnRechargeWinningCappintService $ownRechargeWinningCappingService
    ) {
        $this->ownRechargeInventoryRepository = $ownRechargeInventoryRepository;
        $this->ownRechargeInventoryProductRepository = $ownRechargeInventoryProductRepository;
        $this->recurringScheduleHourService = $recurringScheduleHourService;
        $this->recurringScheduleRepository = $recurringScheduleRepository;
        $this->ownRechargeWinningCappingService = $ownRechargeWinningCappingService;
        $this->setActionRepository($ownRechargeInventoryRepository);
    }

    /**
     * Storing the Store resource
     * @param $data
     * @return Response
     */
    public function storeCampaign($data): Response
    {
        try{
            if($data['deno_type'] != 'all'){
                $flag = $this->checkValidationForProduct($data['product-group']);
                if(!$flag) return new Response("Own Recharge Inventory campaign Created Failed. For Deno, Max Amount and Number of Apply Time is Required");
            }
            if($data['reward_getting_type'] == 'multiple_time' && ($data['max_amount'] == null || $data['number_of_apply_times'] == null)){
                return new Response("Own Recharge Inventory campaign Created Failed. For Campaign, Max Amount and Number of Apply Time is Required");
            }
            if($data['reward_getting_type'] == 'single_time'){
                $data['max_amount'] = null;
                $data['number_of_apply_times'] = null;
            }
            $date_range_array = explode('-', $data['display_period']);
            $data['start_date'] = Carbon::createFromFormat('Y/m/d h:i A', trim($date_range_array[0]))
                ->toDateTimeString();
            $data['end_date'] = Carbon::createFromFormat('Y/m/d h:i A', trim($date_range_array[1]))
                ->toDateTimeString();
            $data['partner_channel_names'] = json_encode($data['partner_channel_names']);
            $data['banner'] = 'storage/' . $data['banner']->store('own_recharge_inventory');
            $data['thumbnail_image'] = 'storage/' . $data['thumbnail_image']->store('own_recharge_inventory');
            
            $campaign = $this->save($data);
            if (isset($data['product-group'])) {
                foreach ($data['product-group'] as $product) {
                    if($data['deno_type'] == 'all'){
                        $product['max_amount']            = null;
                        $product['number_of_apply_times'] = null;
                    }
                    $product['own_recharge_id'] = $campaign->id;
                    $this->ownRechargeInventoryProductRepository->save($product);
                }
            }
            // WINNING LOGIC & CAPPING Storing
            $winningLogicAndCampaign['own_recharge_id']                 = $campaign->id;
            $winningLogicAndCampaign['reward_getting_type']             = $data['reward_getting_type'];
            
            $this->ownRechargeWinningCappingService->create($winningLogicAndCampaign);
            // Storing recurring schedule
            if ($data['recurring_type'] != 'none') {
                $this->saveSchedule(
                    $data['time_ranges'],
                    $campaign->id,
                    $data['weekdays'] ?? null,
                    $data['month_dates'] ?? null
                );
            }

            return new Response("Own Recharge Inventory campaign has been successfully created");
        }catch (\Exception $e){
            return new Response("Own Recharge Inventory campaign Create Failed");
        }

    }

    /**
     * Updating the Store
     * @param $data
     * @param $id
     * @return Response
     */
    public function updateCampaign($data, $id)
    {
        try{
            if($data['deno_type'] != 'all'){
                $flag = $this->checkValidationForProduct($data['product-group']);
                if(!$flag) return new Response("Own Recharge Inventory campaign Created Failed. For Deno, Max Amount and Number of Apply Time is Required");
            }
            if($data['reward_getting_type'] == 'multiple_time' && ($data['max_amount'] == null || $data['number_of_apply_times'] == null)){
                return new Response("Own Recharge Inventory campaign Created Failed. For Campaign, Max Amount and Number of Apply Time is Required");
            }
            if($data['reward_getting_type'] == 'single_time'){
                $data['max_amount'] = null;
                $data['number_of_apply_times'] = null;
            }
            if(isset($data['banner']))$data['banner'] = 'storage/' . $data['banner']->store('own_recharge_inventory');
            if(isset($data['thumbnail_image']))$data['thumbnail_image'] = 'storage/' . $data['thumbnail_image']->store('own_recharge_inventory');
            
            $data['partner_channel_names'] = json_encode($data['partner_channel_names']);
            $date_range_array = explode('-', $data['display_period']);
            $data['start_date'] = Carbon::createFromFormat('Y/m/d h:i A', trim($date_range_array[0]))
                ->toDateTimeString();
            $data['end_date'] = Carbon::createFromFormat('Y/m/d h:i A', trim($date_range_array[1]))
                ->toDateTimeString();
            $campaign = $this->findOne($id);
            
            $this->ownRechargeInventoryProductRepository->deleteCampaignWiseProduct($id);
            if (isset($data['product-group'])) {
                foreach ($data['product-group'] as $product) {
                    if($data['deno_type'] == 'all'){
                        $product['max_amount']            = null;
                        $product['number_of_apply_times'] = null;
                    }
                    $product['own_recharge_id'] = $id;
                    $this->ownRechargeInventoryProductRepository->save($product);
                }
            }
            // if($campaign->campaign_user_type != )
            $campaign->update($data);
            
            // WINNING LOGIC & CAPPING Storing
            $winningLogicAndCampaign['own_recharge_id']                 = $campaign->id;
            $winningLogicAndCampaign['reward_getting_type']             = $data['reward_getting_type'];
            $winning_capping_id                                         = $data['winning_capping_id'];

            $this->ownRechargeWinningCappingService->update($winning_capping_id,$winningLogicAndCampaign);
            // Storing recurring schedule
            if ($data['recurring_type'] != 'none') {
                $this->saveSchedule(
                    $data['time_ranges'],
                    $id,
                    $data['weekdays'] ?? null,
                    $data['month_dates'] ?? null
                );
            }

            return Response('Own Recharge Inventory campaign has been successfully updated');

        }catch (\Exception $e) {
            return Response('Own Recharge Inventory campaign Update Failed');
        }
    }

    /**
     * @param $id
     * @return ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteCampaign($id)
    {
        try{
            $campaign = $this->findOne($id);
            $campaign->delete();
            return Response('Own Recharge Inventory campaign has been successfully deleted');
        }catch (\Exception $e) {

            return Response('Own Recharge Inventory campaign Delete Failed');
        }

    }

    public function getHourSlots()
    {
        return $this->recurringScheduleHourService->getHourSlots('own_recharge_inventory');
    }

    private function saveSchedule($timeSlots, $schedulerId, $weekdays = null, $monthDates = null)
    {
        foreach ($timeSlots as $key => $timeSlot) {
            $timeRange = explode('-', $timeSlot);
            $hourSlotData = [
                'scheduler_id' => $schedulerId,
                'feature' => 'own_recharge_inventory',
                'start_time' => Carbon::parse($timeRange[0])->format('H:i:s'),
                'end_time' => Carbon::parse($timeRange[1])->format('H:i:s'),
                'used' => true
            ];
            $this->recurringScheduleHourService->addOrReplace($hourSlotData, $key === 0 ? true : false);
        }

        $checkSchedule = $this->recurringScheduleRepository->findBy(['schedulable_item_id' => $schedulerId]);

        $scheduleData = [
            'schedulable_item' => 'own_recharge_inventory',
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

    public function checkValidationForProduct($products){
        foreach ($products as $product){
            if($product['max_amount'] == null || $product['number_of_apply_times'] == null)return false;
        }
        return true;
    }
}

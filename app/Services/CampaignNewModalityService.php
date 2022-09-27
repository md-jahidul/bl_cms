<?php

namespace App\Services;

use App\RecurringSchedule;
use App\Repositories\CampaignNewModalityDetailRepository;
use App\Repositories\CampaignNewModalityRepository;
use App\Repositories\NewCampaignModality\CampaignPurchaseReportRepository;
use App\Repositories\ProductCoreRepository;
use App\Repositories\RecurringScheduleRepository;
use App\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class CampaignNewModalityService
{
    use CrudTrait;

    /**
     * @var CampaignNewModalityDetailRepository
     */
    private $campaignNewModalityDetailRepository;
    /**
     * @var CampaignNewModalityRepository
     */
    private $campaignNewModalityRepository;
    /**
     * @var RecurringScheduleHourService
     */
    private $recurringScheduleHourService;
    /**
     * @var RecurringScheduleRepository
     */
    private $recurringScheduleRepository;
    private $campaignPurchaseReportRepository;
    /**
     * @var ProductCoreRepository
     */
    private $productCoreRepository;

    public function __construct(
        CampaignNewModalityRepository $campaignNewModalityRepository,
        CampaignNewModalityDetailRepository $campaignNewModalityDetailRepository,
        RecurringScheduleHourService $recurringScheduleHourService,
        RecurringScheduleRepository $recurringScheduleRepository,
        CampaignPurchaseReportRepository $campaignPurchaseReportRepository,
        ProductCoreRepository $productCoreRepository
    ) {
        $this->campaignNewModalityRepository = $campaignNewModalityRepository;
        $this->campaignNewModalityDetailRepository = $campaignNewModalityDetailRepository;
        $this->recurringScheduleHourService = $recurringScheduleHourService;
        $this->recurringScheduleRepository = $recurringScheduleRepository;
        $this->campaignPurchaseReportRepository = $campaignPurchaseReportRepository;
        $this->productCoreRepository = $productCoreRepository;
        $this->setActionRepository($campaignNewModalityRepository);
    }

    /**
     * Storing the Store resource
     * @param $data
     * @return Response
     */
    public function storeCampaign($data): Response
    {
        try {
            if ($data['reward_getting_type'] == 'single_time') {
                $data['max_amount'] = null;
                $data['number_of_apply_times'] = null;
            }
            $campaign = $this->save($data);

            if (isset($data['campaign_details'])) {
                foreach ($data['campaign_details'] as $product) {
                    if (isset($product['product_code'])) {
                        $coreProduct = $this->productCoreRepository->findOneByProperties(
                            ['product_code' => $product['product_code']],
                            ['sim_type']
                        );
                        $product['product_for'] = isset($coreProduct->sim_type) ? ($coreProduct->sim_type == 1 ? "prepaid" : "postpaid") : null;
                    }
                    if (!empty($product['thumb_image'])) {
                        $product['thumb_image'] = 'storage/' . $product['thumb_image']->store('mybl_new_campaign');
                    }

                    if (!empty($product['banner_image'])) {
                        $product['banner_image'] = 'storage/' . $product['banner_image']->store('mybl_new_campaign');
                    }

                    if (!empty($product['popup_image'])) {
                        $product['popup_image'] = 'storage/' . $product['popup_image']->store('mybl_new_campaign');
                    }
                    if ($data['deno_type'] == 'all') {
                        $product['max_amount'] = null;
                        $product['number_of_apply_times'] = null;
                    }
                    $product['my_bl_campaign_id'] = $campaign->id;
                    $this->campaignNewModalityDetailRepository->save($product);
                }
            }

            // Storing recurring schedule
            if ($data['recurring_type'] != 'none') {
                $this->saveSchedule(
                    $data['time_ranges'],
                    $campaign->id,
                    $data['weekdays'] ?? null,
                    $data['month_dates'] ?? null
                );
            }

            return new Response("New Campaign Modality has been successfully created");
        } catch (\Exception $e) {
            $error = $e->getMessage();
            dd($error);
            Log::error($error);
            return new Response("New Campaign Modality campaign Create Failed. Error: $error");
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
        try {
            if ($data['reward_getting_type'] == 'single_time') {
                $data['max_amount'] = null;
                $data['number_of_apply_times'] = null;
            }

            if (isset($data['payment_channels'])) {
                $data['payment_channels'] = json_encode($data['payment_channels']);
            }
            if (isset($data['payment_gateways'])) {
                $data['payment_gateways'] = json_encode($data['payment_gateways']);
            }

            $campaign = $this->findOne($id);

            if (isset($data['campaign_details'])) {
                foreach ($data['campaign_details'] as $product) {
                    $campaignDetails = $this->campaignNewModalityDetailRepository->findOne(
                        $product['campaign_details_id'] ?? 0
                    );

                    if (isset($product['product_code'])) {
                        $coreProduct = $this->productCoreRepository->findOneByProperties(
                            ['product_code' => $product['product_code']],
                            ['sim_type']
                        );
                        $product['product_for'] = isset($coreProduct->sim_type) ? ($coreProduct->sim_type == 1 ? "prepaid" : "postpaid") : null;
                    }

                    $product['show_in_home'] = isset($product['show_in_home']) ? 1 : 0;
                    if (!empty($product['thumb_image'])) {
                        $product['thumb_image'] = 'storage/' . $product['thumb_image']->store('mybl_new_campaign');
                        if (isset($campaignDetails) && file_exists($campaignDetails->thumb_image)) {
                            unlink($campaignDetails->thumb_image);
                        }
                    }

                    if (!empty($product['banner_image'])) {
                        $product['banner_image'] = 'storage/' . $product['banner_image']->store('mybl_new_campaign');
                        if (isset($campaignDetails) && file_exists($campaignDetails->banner_image)) {
                            unlink($campaignDetails->banner_image);
                        }
                    }

                    if (!empty($product['popup_image'])) {
                        $product['popup_image'] = 'storage/' . $product['popup_image']->store('mybl_new_campaign');
                        if (isset($campaignDetails) && file_exists($campaignDetails->popup_image)) {
                            unlink($campaignDetails->popup_image);
                        }
                    }
                    if (isset($campaignDetails)) {
                        $campaignDetails->update($product);
                    } else {
                        $product['my_bl_campaign_id'] = $id;
                        $this->campaignNewModalityDetailRepository->save($product);
                    }
                }
            }

            $data['first_sign_up_user'] = isset($data['first_sign_up_user']) ? 1 : 0;
            $campaign->update($data);

            // Storing recurring schedule
            if ($data['recurring_type'] != 'none') {
                $this->saveSchedule(
                    $data['time_ranges'],
                    $id,
                    $data['weekdays'] ?? null,
                    $data['month_dates'] ?? null
                );
            }

            return Response('Campaign has been successfully updated');
        } catch (\Exception $e) {
            return Response("Campaign Update Failed. Error: $e");
        }
    }

    public function getHourSlots()
    {
        return $this->recurringScheduleHourService->getHourSlots('new_campaign_modality');
    }

    private function saveSchedule($timeSlots, $schedulerId, $weekdays = null, $monthDates = null)
    {
        foreach ($timeSlots as $key => $timeSlot) {
            $timeRange = explode('-', $timeSlot);
            $hourSlotData = [
                'scheduler_id' => $schedulerId,
                'feature' => 'new_campaign_modality',
                'start_time' => Carbon::parse($timeRange[0])->format('H:i:s'),
                'end_time' => Carbon::parse($timeRange[1])->format('H:i:s'),
                'used' => true
            ];
            $this->recurringScheduleHourService->addOrReplace($hourSlotData, $key === 0 ? true : false);
        }

        $checkSchedule = $this->recurringScheduleRepository->findBy(['schedulable_item_id' => $schedulerId]);

        $scheduleData = [
            'schedulable_item' => 'new_campaign_modality',
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

    public function analyticsData($date, $campaignId)
    {
        $purchaseCodes = $this->campaignPurchaseReportRepository->purchaseCodeWithMsisdn($date, $campaignId);
        foreach ($purchaseCodes as $key => $purchaseCode) {
            $total_success = $this->purchaseStatusCount($purchaseCode, 'action_type', 'buy_success');
            $total_failed = $this->purchaseStatusCount($purchaseCode, 'action_type', 'buy_failure');

            $purchaseCodes[$key]['total_success'] = $total_success;
            $purchaseCodes[$key]['total_failed'] = $total_failed;
        }
        return $purchaseCodes;
    }

    public function msisdnPurchaseDetails($request, $id)
    {
        return $this->campaignNewModalityRepository->msisdnInfo($request, $id);
    }
    /**
     * @param $id
     * @return ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteCampaign($id)
    {
        try {
            $campaign = $this->findOne($id);
            $campaign->delete();
            return Response('Campaign has been successfully deleted');
        } catch (\Exception $e) {
            return Response('Campaign Delete Failed');
        }
    }
    public function purchaseStatusCount($campaign, $column, $colValue)
    {
        return collect($campaign->msisdnReports)->sum(function ($data) use ($column, $colValue) {
            if ($data->{$column} == $colValue) {
                return true;
            }
            return false;
        });
    }

}

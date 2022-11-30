<?php

namespace App\Services\NewCampaignModality;

use App\Models\MasterLog;
use App\Models\NotificationDraft;
use App\Services\BlApiHub\BaseService;
use App\Services\PushNotificationService;
use Carbon\Carbon;
use App\Repositories\CampaignNewModalityDetailRepository as MyBlNewCampaignProductRepository;
use App\Repositories\CampaignNewModalityWinnerRepository as MyBlNewCampaignWinnerRepository;
use App\Repositories\CampaignNewModalityUserRepository as MyBlNewCampaignUserRepository;
use Illuminate\Support\Facades\Log;

class MyBlCampaignWinnerSelectionService extends BaseService
{
    /**
     * @const PURCHASE_ENDPOINT
     */
    protected const PURCHASE_ENDPOINT = "/provisioning/provisioning/purchase";

    /**
     * 1. Fetch all visible & active campaigns
     * 2. For Each -> Campaign , Find out the intervals slot
     */

    /**
     * Fetch All First Type Products With Campaigns
     * Fetch createdAt from campaign_users
     *      where (campaignId, campaignDetailId, winnerType)
     *      OrderBy createdAt Ascending
     *      take first,
     * Determine slot of the associated campaign in which the createdAt falls into
     * Store it in winners table if not already else skip/continue
     */

    /**
     * Fetch All Max Type Products (Where Product Run Complete) With Campaigns
     * Generate the slots of these campaigns ie: "campaign_id, campaignDetailId, slotStart slotEnd"
     * Loop through the slotArr adn query
     *      campaignUser where campaignId, campaignDetailId, SUM(recharge/purchaseAmount), createdAt->between(Slots)
     *      OrderBy rechargeSum Descending
     *      take first
     * ie: Auth::user()->orderByRaw('SUM(points) DESC')->first();
     * Determine slot of the associated campaign in which the createdAt falls into
     * Store it in winners table if not already else skip/continue
     */

    public function processCampaignWinner()
    {
        $myBlNewCampaignProductRepository = resolve(MyBlNewCampaignProductRepository::class);
        $productsByWinningTypes = $myBlNewCampaignProductRepository->getRunningCampaignProducts();
        // dd($productsByWinningTypes, Carbon::now()->toDateTimeString());
        $status = [];
        foreach ($productsByWinningTypes as $product) {
            $status[] = $this->processWinner($product);
        }

        dump($status);
    }

    private function processWinner($product)
    {
        $winningType = explode('_', $product->campaign->winning_type)[0];
        $myBlNewCampaignUserRepository = resolve(MyBlNewCampaignUserRepository::class);
        $myBlNewCampaignWinnerRepository = resolve(MyBlNewCampaignWinnerRepository::class);

        $slots = $this->determineSlots($product);

        foreach ($slots as $slot) {
            $slotStarts = Carbon::parse($slot['slot_start_at'])->toDateTimeString();
            $slotEnds = Carbon::parse($slot['slot_end_at'])->toDateTimeString();
            $candidiate = null;

            if ($winningType == 'first') {
                $candidiate = $myBlNewCampaignUserRepository->getCampaignFirstTypeUser(
                    $product,
                    $slotStarts,
                    $slotEnds
                );
            }

            if ($winningType == 'highest') {
                $candidiate = $myBlNewCampaignUserRepository->getCampaignHighestTypeUser(
                    $product,
                    $slotStarts,
                    $slotEnds
                );
            }

            if (is_null($candidiate)) {
                continue;
            }

            $winnerData = $this->buildWinnerData($product, $candidiate, $slotStarts, $slotEnds);
            $sendNotification = $myBlNewCampaignWinnerRepository->setWinner($winnerData);

            if ($sendNotification) {
                $user_phone = $winnerData['msisdn'];
                try {
                    $param = [
                        'id' => $product->campaign->bonus_product_code,
                        'msisdn' => "880" . $user_phone
                    ];

                    $result = $this->post(self::PURCHASE_ENDPOINT, $param);
                    Log::info('Campaign modality reward dispatching. Response .' . json_encode($result));

                    if ($result['status_code'] == 200) {
                        $saveLogData['status'] = 200;
                        $saveLogData['msisdn'] = $user_phone;
                        $saveLogData['date'] = Carbon::now()->toDateString();
                        $saveLogData['message'] = "Purchase request in Progress";
                        $saveLogData['response'] = $result['response'];
                        $saveLogData['log_type'] = "CAMPAIGN-MODALITY";
                        $saveLogData['others'] = $winnerData['product_code'];
                        MasterLog::create($saveLogData);

                        $notification = [
                            'title' => $product->campaign->winning_title,
                            'body' => $product->campaign->winning_massage_en,
                            "send_to_type" => "INDIVIDUALS",
                            "recipients" => ["0" . $user_phone],
                            "is_interactive" => "YES",
                            "data" => [
                                "cid" => "1",
                                "url" => "https://www.banglalink.net",
                                "component" => "offer",
                            ]
                        ];

                        $response = PushNotificationService::sendPersistentNotification($notification);

                        $notify = json_decode($response);
                        if ($notify->status == "SUCCESS") {
                            Log::info("Campaign Notification Send Successfully");
                        }
                    } else {
                        Log::info("Campaign modality Purchase Failed. response:" . json_encode($result));
                    }
                } catch (\Exception $e) {
                    Log::error("Campaign Notification Send Failed", [$e->getMessage()]);
                }
            }
        }

        return true;
    }

    private function buildWinnerData($product, $user, $slotStarts, $slotEnds)
    {
        return [
            'my_bl_campaign_id' => $product->campaign->id,
            'my_bl_campaign_detail_id' => $product->id,
            'msisdn' => $user->msisdn,
            'product_code' => $product->product_code ?? null,
            'recharge_amount' => $user->amount_sum ?? $user->amount ?? $product->recharge_amount ?? null,
            'bonus_product_code' => $product->campaign->bonus_product_code ?? null,
            'winning_slot_start' => $slotStarts,
            'winning_slot_end' => $slotEnds
        ];
    }

    /**
     * Determine Slots
     * slotStartsAt = campaignStartsAt
     * slotEndsAt = slotStartsAt + campaignInterval
     * while slotEndsAt <= campaignEndsAt
     */
    private function determineSlots($product)
    {
        $slots = [];
        $currentTime = Carbon::now();
        $campaign = $product->campaign;

        if ($campaign->winning_type == 'no_logic' || is_null($campaign->winning_interval_unit)
        ) {
            return $slots;
        }

        $slotInterval = $campaign->winning_interval;
        $slotIntervalUnit = ucfirst($campaign->winning_interval_unit) . 's';
        $addTime = 'add' . $slotIntervalUnit;

        $campaignStartsAt = Carbon::parse($campaign->start_date);
        $campaignEndsAt = Carbon::parse($campaign->end_date);
        $productStartsAt = Carbon::parse($product->start_date);
        $productEndsAt = Carbon::parse($product->end_date);

        // addExtra Interval For MaxRecharge with $campaignEndsAt For Max Type
        $currentTimePastXIntervals = Carbon::parse($currentTime)->$addTime(-$slotInterval * 1);

        $slotStartsAt = Carbon::parse($campaign->start_date);
        $slotEndsAt = Carbon::parse($slotStartsAt)->$addTime($slotInterval);

        while ($productEndsAt->gte($campaignStartsAt) && $slotEndsAt->lte($campaignEndsAt)) {

            // Only generate Current Slot
            // if(!$currentTime->gt($slotStartsAt)) {

            //     $slotStartsAt = Carbon::parse($slotEndsAt);
            //     $slotEndsAt = Carbon::parse($slotStartsAt)->$addTime($slotInterval);
            //     continue;
            //     // break;
            // }

            // Only generate *slots* continuing/running And past/complete && For FirstType Campaign
            // Not accepting future/upcoming slots
            // if($campaign->winning_type == 'first_recharge' && $currentTime->lt($slotStartsAt)) {

            //     $slotStartsAt = Carbon::parse($slotEndsAt);
            //     $slotEndsAt = Carbon::parse($slotStartsAt)->$addTime($slotInterval);
            //     // continue;
            //     break;
            // }

            // Only generate *slots* past/complete && For MaxType Campaign
            // Not accepting running/continuing + future/upcomming slots
            // if($campaign->winning_type == 'highest_recharge' && $currentTime->lt($slotEndsAt)) {

            //     $slotStartsAt = Carbon::parse($slotEndsAt);
            //     $slotEndsAt = Carbon::parse($slotStartsAt)->$addTime($slotInterval);
            //     // continue;
            //     break;
            // }

            // Only generate X *slots* past/complete && For All Type Campaign
            // Not accepting running/continuing + future/upcomming slots
            if ($currentTimePastXIntervals->gt($slotEndsAt)) {
                $slotStartsAt = Carbon::parse($slotEndsAt);
                $slotEndsAt = Carbon::parse($slotStartsAt)->$addTime($slotInterval);

                continue;
            }

            // Only generate *slots* past/complete && For All Type Campaign
            // Not accepting running/continuing + future/upcomming slots
            if ($currentTime->lt($slotEndsAt)) {
                $slotStartsAt = Carbon::parse($slotEndsAt);
                $slotEndsAt = Carbon::parse($slotStartsAt)->$addTime($slotInterval);

                break;
            }

            // Not accepting if product is not running in the slot
            if ($productEndsAt->lte($slotStartsAt) || $productStartsAt->gte($slotEndsAt)) {
                $slotStartsAt = Carbon::parse($slotEndsAt);
                $slotEndsAt = Carbon::parse($slotStartsAt)->$addTime($slotInterval);

                continue;
            }

            $slots[] = [
                'campaign_id' => $campaign->id,
                'slot_start_at' => $slotStartsAt->toDateTimeString(),
                'slot_end_at' => $slotEndsAt->toDateTimeString()
            ];

            $slotStartsAt = Carbon::parse($slotEndsAt);
            $slotEndsAt = Carbon::parse($slotStartsAt)->$addTime($slotInterval);
        }

        return $slots;
    }
}

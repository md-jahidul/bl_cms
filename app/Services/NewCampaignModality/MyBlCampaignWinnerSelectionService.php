<?php

namespace App\Services\NewCampaignModality;

use Carbon\Carbon;
use App\Repositories\CampaignNewModalityDetailRepository as MyBlNewCampaignProductRepository;
use App\Repositories\CampaignNewModalityWinnerRepository as MyBlNewCampaignWinnerRepository;
use App\Repositories\CampaignNewModalityUserRepository as MyBlNewCampaignUserRepository;

class MyBlCampaignWinnerSelectionService {

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

    public function processCampaignWinner() {

      $myBlNewCampaignProductRepository = resolve(MyBlNewCampaignProductRepository::class);
      $productsByWinningTypes = $myBlNewCampaignProductRepository->getRunningCampaignProducts();
      // dd($productsByWinningTypes, Carbon::now()->toDateTimeString());
      $status = [];
      foreach($productsByWinningTypes as $product) {
          $status[] = $this->processWinner($product);
      }

      dump($status);
  }

  private function processWinner($product) 
  {
      $myBlNewCampaignUserRepository = resolve(MyBlNewCampaignUserRepository::class);
      $myBlNewCampaignWinnerRepository = resolve(MyBlNewCampaignWinnerRepository::class);

      $slots = $this->determineSlots($product);
      
      foreach($slots as $slot) {
          $slotStarts = Carbon::parse($slot['slot_start_at'])->toDateTimeString();
          $slotEnds = Carbon::parse($slot['slot_end_at'])->toDateTimeString();
          $candidiate = null;

          if($product->campaign->winning_type == 'first_recharge') {
              $candidiate = $myBlNewCampaignUserRepository->getCampaignFirstTypeUser($product, $slotStarts, $slotEnds);
          }
          
          if($product->campaign->winning_type == 'highest_recharge') {
              $candidiate = $myBlNewCampaignUserRepository->getCampaignHighestTypeUser($product, $slotStarts, $slotEnds);
          }
          
          if(is_null($candidiate)) {
              continue;
          }

          $winnerData = $this->buildWinnerData($product, $candidiate, $slotStarts, $slotEnds);
          $myBlNewCampaignWinnerRepository->setWinner($winnerData);
      }

      return true;
  }

  private function buildWinnerData($product, $user, $slotStarts, $slotEnds) 
  {
      return [
          'my_bl_campaign_id' => $product->campaign->id,
          'my_bl_campaign_detail_id' => $product->id,
          'msisdn' => $user->msisdn,
          'product_code' => $product->product_code,
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
  private function determineSlots($product) {
      $slots = [];
      $currentTime = Carbon::now();
      $campaign = $product->campaign;

      if($campaign->winning_type == 'no_logic' || is_null($campaign->winning_interval_unit)
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

      $currentTimePastXIntervals = Carbon::parse($currentTime)->$addTime(- $slotInterval * 4); // addExtra Interval For MaxRecharge with $campaignEndsAt For Max Type
      $slotStartsAt = Carbon::parse($campaign->start_date);
      $slotEndsAt = Carbon::parse($slotStartsAt)->$addTime($slotInterval);

      while($productEndsAt->gte($campaignStartsAt) && $productEndsAt->lte($campaignEndsAt) && $slotEndsAt->lte($campaignEndsAt)) {

          // Only generate Current Slot
          // if(!$currentTime->gt($slotStartsAt) && !$currentTime->lt($slotEndsAt)) {
              
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
          if($currentTimePastXIntervals->gt($slotEndsAt)) {
              $slotStartsAt = Carbon::parse($slotEndsAt);
              $slotEndsAt = Carbon::parse($slotStartsAt)->$addTime($slotInterval);

              continue;
          }

          // Only generate *slots* past/complete && For All Type Campaign
          // Not accepting running/continuing + future/upcomming slots
          if($currentTime->lt($slotEndsAt)) {
  
              $slotStartsAt = Carbon::parse($slotEndsAt);
              $slotEndsAt = Carbon::parse($slotStartsAt)->$addTime($slotInterval);

              break;
          }

          // Not accepting if product is not running in the slot
          if($productEndsAt->lte($slotStartsAt) || $productStartsAt->gte($slotEndsAt)) {

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
<?php

namespace App\Services;

use App\Repositories\MyblCashBackProductRepository;
use App\Repositories\MyblCashBackRepository;
use App\Repositories\MyblOwnRechargeInventoryProductRepository;
use App\Repositories\MyblOwnRechargeInventoryRepository;
use App\Traits\CrudTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class MyblOwnRechargeInventoryService
{
    use CrudTrait;

    private $ownRechargeInventoryRepository;
    private $ownRechargeInventoryProductRepository;

    public function __construct(
        MyblOwnRechargeInventoryRepository $ownRechargeInventoryRepository,
        MyblOwnRechargeInventoryProductRepository $ownRechargeInventoryProductRepository
    ) {
        $this->ownRechargeInventoryRepository = $ownRechargeInventoryRepository;
        $this->ownRechargeInventoryProductRepository = $ownRechargeInventoryProductRepository;
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
            $data['partner_channel_names'] = json_encode($data['partner_channel_names']);
            $data['banner'] = 'storage/' . $data['banner']->store('own_recharge_inventory');
            $data['thumbnail_image'] = 'storage/' . $data['thumbnail_image']->store('own_recharge_inventory');

            $campaign = $this->save($data);
            if (isset($data['product-group'])) {
                foreach ($data['product-group'] as $product) {
                    $product['own_recharge_id'] = $campaign->id;
                    $this->ownRechargeInventoryProductRepository->save($product);
                }
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
            
            $data['partner_channel_names'] = json_encode($data['partner_channel_names']);
            $campaign = $this->findOne($id);
            
            $this->ownRechargeInventoryProductRepository->deleteCampaignWiseProduct($id);
            if (isset($data['product-group'])) {
                foreach ($data['product-group'] as $product) {
                    $product['own_recharge_id'] = $id;
                    $this->ownRechargeInventoryProductRepository->save($product);
                }
            }
            // if($campaign->campaign_user_type != )
            $campaign->update($data);
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
}

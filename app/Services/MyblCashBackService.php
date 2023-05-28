<?php

namespace App\Services;

use App\Repositories\MyblCashBackProductRepository;
use App\Repositories\MyblCashBackRepository;
use App\Traits\CrudTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class MyblCashBackService
{
    use CrudTrait;

    /**
     * @var MyblCashBackRepository
     */
    private $cashBackRepository;

    /**
     * @var MyblCashBackProductRepository
     */
    private $cashBackProductRepo;

    /**
     * MyblCashBackService constructor.
     * @param MyblCashBackRepository $cashBackRepository
     */
    public function __construct(
        MyblCashBackRepository $cashBackRepository,
        MyblCashBackProductRepository $cashBackProductRepository
    ) {
        $this->cashBackRepository = $cashBackRepository;
        $this->cashBackProductRepo = $cashBackProductRepository;
        $this->setActionRepository($cashBackRepository);
    }

    /**
     * Storing the Store resource
     * @param $data
     * @return Response
     */
    public function storeCampaign($data): Response
    {
        $campaign = $this->save($data);
        if (isset($data['product-group'])) {
            foreach ($data['product-group'] as $product) {
                if(isset($product['override_other_campaign'])) {
                    $product['override_other_campaign'] = 1;
                }

                $product['start_date'] = ($product['start_date'] == null ? $data['start_date'] : $product['start_date']);
                $product['end_date'] = ($product['end_date'] == null ? $data['end_date'] : $product['end_date']);
                $product['mybl_cash_back_id'] = $campaign->id;
                $this->cashBackProductRepo->save($product);
            }
        }
        return new Response("Cash Back campaign has been successfully created");
    }

    /**
     * Updating the Store
     * @param $data
     * @param $id
     * @return Response
     */
    public function updateCampaign($data, $id)
    {
        $campaign = $this->findOne($id);
        $this->cashBackProductRepo->deleteCampaignWiseProduct($id);
        if (isset($data['product-group'])) {
            foreach ($data['product-group'] as $product) {
                if(isset($product['override_other_campaign'])) {
                    $product['override_other_campaign'] = 1;
                }
                else {
                    $product['override_other_campaign'] = 0;
                }

                $product['start_date'] = ($product['start_date'] == null ? $data['start_date'] : $product['start_date']);
                $product['end_date'] = ($product['end_date'] == null ? $data['end_date'] : $product['end_date']);

                $product['mybl_cash_back_id'] = $id;
                $this->cashBackProductRepo->save($product);
            }
        }

        $campaign->update($data);
        return Response('Cash back campaign has been successfully updated');
    }

    /**
     * @param $id
     * @return ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteCampaign($id)
    {
        $campaign = $this->findOne($id);
        $campaign->delete();
        return Response('Cash back campaign has been successfully deleted');
    }
}

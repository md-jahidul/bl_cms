<?php
/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 1:15 PM
 */

namespace App\Services;


use App\Repositories\CampaignRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;

class CampaignService
{
    use CrudTrait;

    /**
     * @var $campaignService
     */
    protected $campaignService;

    /**
     * CampaignService constructor.
     * @param CampaignRepository $campaignRepository
     */
    public function __construct(CampaignRepository $campaignRepository)
    {
        $this->campaignService = $campaignRepository;
        $this->setActionRepository($campaignRepository);
    }

    /**
     * @param $data
     * @return Response
     */
    public function storeCampaign($data)
    {
        //Todo:: validation required

//        echo '<pre>';
//        print_r($data);die();

        $this->save($data);
        return new Response('Campaign added successfully');
    }

    /**
     * @param $data
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function updateCampaign($data, $id)
    {
      $campaign = $this->findOne($id);
      $campaign->update($data);
      return Response('Campaign update successfully');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteCampaign($id)
    {
        $campaign = $this->findOne($id);
        $campaign->delete();
        return Response('Campaign deleted successfully');
    }

}
<?php


namespace App\Services;


use App\Repositories\PartnerRepository;
use App\Repositories\PrizeRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;

class PartnerService
{
    use CrudTrait;

    /**
     * @var $partnerRepository
     */
    protected $partnerRepository;

    /**
     * PartnerService constructor.
     * @param PartnerRepository $partnerRepository
     */

    public function __construct(PartnerRepository $partnerRepository)
    {
        $this->partnerRepository = $partnerRepository;
        $this->setActionRepository($partnerRepository);
    }


    /**
     * @param $data
     * @return Response
     */
    public function storePartner($data)
    {

//        $imageUrl = $this->imageUpload($data, "company_logo", $data['company_name'], 'images/partners-logo');
//        $data['company_logo'] = $imageUrl;
        $this->save($data);
        return new Response('Partner added successfully');
    }



    /**
     * @param $data
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function updatePartner($data, $id)
    {
        $partner = $this->findOne($id);
//        if (!empty($data['company_logo'])){
//            $imageUrl = $this->imageUpload($data, "company_logo", $data['company_name'], 'images/partners-logo');
//            $data['company_logo'] = $imageUrl;
//        }
        $partner->update($data);
        return Response('Partner update successfully !');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function deletePartner($id)
    {
        $partner = $this->findOne($id);
        $partner->delete();
        return Response('Partner delete successfully');
    }
}

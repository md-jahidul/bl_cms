<?php


namespace App\Services;

use App\Models\PartnerCategory;
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
     * @return mixed
     */
    public function partnerCategories()
    {
        return PartnerCategory::select('id', 'name_en')->get();
    }

    /**
     * @param $data
     * @return Response
     */
    public function storePartner($data)
    {
        $imageUrl = $this->imageUpload($data, "company_logo", $data['company_name_en'], 'images/partners-logo');
        $data['company_logo'] = env('APP_URL', 'http://localhost:8000').'/images/partners-logo/'. $imageUrl;
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
        if (!empty($data['company_logo'])) {
            $imageUrl = $this->imageUpload($data, "company_logo", $data['company_name_en'], 'images/partners-logo');
            $data['company_logo'] = env('APP_URL', 'http://localhost:8000').'/images/partners-logo/'. $imageUrl;
        }
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

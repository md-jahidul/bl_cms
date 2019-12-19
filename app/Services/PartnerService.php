<?php

namespace App\Services;

use App\Models\PartnerCategory;
use App\Repositories\PartnerRepository;
use App\Repositories\PrizeRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class PartnerService
{
    use CrudTrait;
    use FileTrait;

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
        if (request()->hasFile('company_logo')) {
            $data['company_logo'] = $this->upload($data['company_logo'], 'assetlite/images/partners-logo');
        }
        $this->save($data);
        return new Response('Partner added successfully');
    }



    /**
     * @param $data
     * @param $id
     * @return ResponseFactory|Response
     */
    public function updatePartner($data, $id)
    {
        $partner = $this->findOne($id);
        if (request()->hasFile('company_logo')) {
            $data['company_logo'] = $this->upload($data['company_logo'], 'assetlite/images/partners-logo');
            $this->deleteFile($partner['company_logo']);
        }
        $partner->update($data);
        return Response('Partner update successfully!');
    }

    /**
     * @param $id
     * @return ResponseFactory|Response
     * @throws Exception
     */
    public function deletePartner($id)
    {
        $partner = $this->findOne($id);
        $this->deleteFile($partner['company_logo']);
        $partner->delete();
        return Response('Partner delete successfully');
    }
}

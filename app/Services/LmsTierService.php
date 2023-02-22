<?php

namespace App\Services;

use App\Repositories\LmsOfferCategoryRepository;
use App\Repositories\LmsTierRepository;
use App\Traits\CrudTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class LmsTierService
{
    use CrudTrait;
    /**
     * @var LmsTierRepository
     */
    private $lmsTierRepository;

    /**
     * LmsTierService constructor.
     * @param LmsTierRepository $lmsTierRepository
     */
    public function __construct(LmsTierRepository $lmsTierRepository)
    {
        $this->lmsTierRepository = $lmsTierRepository;
        $this->setActionRepository($lmsTierRepository);
    }

    /**
     * Storing the slider resource
     * @return Response
     */
    public function storeLmsTier($data)
    {
        $lmsTiers = $this->findAll();
        $data['display_order'] = $lmsTiers->count() + 1;
        $this->save($data);
        return new Response('Lms tier added successfully');
    }

    /**
     * @param $data
     * @param $id
     * @return ResponseFactory|Response
     */
    public function updateLmsTier($data, $id)
    {
        $lmsTier = $this->findOne($id);
        $lmsTier->update($data);
        return Response('LMS tier updated successfully !');
    }

    /**
     * @param $data
     * @return Response
     */
    public function tableSortable($position)
    {
        $this->lmsTierRepository->sortData($position);
        return new Response('update successfully');
    }

    /**
     * @param $id
     * @return ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteLmsTier($id)
    {
        $lmsOfferCat = $this->findOne($id);
        $lmsOfferCat->delete();
        return Response('LMS tier deleted successfully !');
    }
}

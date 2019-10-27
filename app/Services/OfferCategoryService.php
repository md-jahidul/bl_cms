<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 26-Aug-19
 * Time: 4:31 PM
 */

namespace App\Services;

use App\Repositories\OfferCategoryRepository;
use App\Traits\CrudTrait;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class OfferCategoryService
{
    use CrudTrait;

    /**
     * @var $offerCategoryRepository
     */
    protected $offerCategoryRepository;

    /**
     * OfferCategoryService constructor.
     * @param OfferCategoryRepository $offerCategoryRepository
     */
    public function __construct(OfferCategoryRepository $offerCategoryRepository)
    {
        $this->offerCategoryRepository = $offerCategoryRepository;
        $this->setActionRepository($offerCategoryRepository);
    }

    /**
     * @param $data
     * @return Response
     */
    public function storeOfferCategory($data)
    {
        $data['alias'] = str_replace(" ", "_", strtolower($data['name']));
        $this->save($data);
        return new Response('Offer category added successfully');
    }

    /**
     * Updating the OfferCategory
     * @param $data
     * @return Response
     */
    public function updateOfferCategory($data, $id)
    {
        $offerCategory = $this->findOne($id);
        $data['alias'] = str_replace(" ", "_", strtolower($data['name']));
        $offerCategory->update($data);
        return Response('Offer category updated successfully');
    }


    /**
     * @param $id
     * @return ResponseFactory|Response
     * @throws Exception
     */
    public function deleteOfferCategory($id)
    {
        $offerCategory = $this->findOne($id);
        $offerCategory->delete();
        return Response('Offer category deleted successfully !');
    }
}

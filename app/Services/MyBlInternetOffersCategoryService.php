<?php

namespace App\Services;

use App\Traits\CrudTrait;
use Exception;
use Illuminate\Http\Response;
use App\Repositories\MyBlInternetOffersCategoryRepository;
use Illuminate\Http\Request;

class MyBlInternetOffersCategoryService
{
    use CrudTrait;

   /**
     * @var $internetOffersCategoryRepository
     */
    protected $internetOffersCategoryRepository;

    /**
     * DigitalServicesService constructor.
     * @param InternetOffersCategoryRepository $internetOffersCategoryRepository
     */

    public function __construct(MyBlInternetOffersCategoryRepository $internetOffersCategoryRepository)
    {
        $this->internetOffersCategoryRepository = $internetOffersCategoryRepository;
        $this->setActionRepository($internetOffersCategoryRepository);
    }

    /**
     * Undocumented function
     *
     * @param [type] $data
     * @return Response
     */
    public function storeInternetOffersCategory($data): Response
    {
        $this->internetOffersCategoryRepository->save($data);
        return new Response("Internet Offer has been successfully created");
    }
    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function delFilter($id)
    {
        try {
            $filter = $this->findOne($id);
            $filter->delete();
            $response = [
                'status' => 'SUCCESS',
                'message' => 'Filter deleted Successfully'
            ];

            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => ' FAILED',
                'message' => $e->getMessage()
            ], 500);
        }
    }

     /**
     * Updating the internet offer category
     * @param $data
     * @return Response
     */

    public function updateInternetOffersCategory($request, $id)
    {
        $nearByOffer = $this->findOne($id);
        $nearByOffer->update($request);
        return Response('MyBl Internet Offers Category has been successfully updated');
    }


}

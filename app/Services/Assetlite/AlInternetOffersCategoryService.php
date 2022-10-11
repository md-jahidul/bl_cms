<?php

namespace App\Services\Assetlite;

use App\Models\MyBlInternetOffersCategory;
use App\Models\MyBlProductTab;
use App\Traits\CrudTrait;
use Exception;
use Illuminate\Http\Response;
use App\Repositories\MyBlInternetOffersCategoryRepository;
use Illuminate\Http\Request;

class AlInternetOffersCategoryService
{
    use CrudTrait;

   /**
     * @var $internetOffersCategoryRepository
     */
    protected $internetOffersCategoryRepository;

    /**
     * @param MyBlInternetOffersCategoryRepository $internetOffersCategoryRepository
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
     * @return void
     */
   public function storeInternetOffersCategory($data)
    {
        try{
            $data['platform'] = 'al';
            $this->internetOffersCategoryRepository->save($data);
            return [
                "status" => 200,
                "message" => 'Product Category has been successfully created'
            ];
        }catch (\Exception $e){
            return [
                "status" => 500,
                "message" => 'Product Category has been created Failed'
            ];
        }
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
        try {
            $request['platform'] = 'al';
            $nearByOffer = $this->findOne($id);
            $nearByOffer->update($request);
            return [
                "status" => 200,
                "message" => 'Product Category has been successfully updated'
            ];
        }catch (\Exception $e){
            return [
                "status" => 500,
                "message" => 'Product Category Update Failed'
            ];
        }
    }

    public function storeProductTabs($product_code, $categorys){
        if(!is_null($categorys)) {
            foreach ($categorys as $category) {
                $data ['product_code'] = $product_code;
                $data ['platform'] = 'al';
                $data ['my_bl_internet_offers_category_id'] = $category;

                MyBlProductTab::create($data);
            }
        }
    }

    public function selectedCategory($product_code){

        $data =  MyBlProductTab::where('product_code', $product_code)
                                ->where('platform', 'al')
                                ->select('my_bl_internet_offers_category_id')->get();
        $data = $data->toArray();
        $selectedCategory = array();

        foreach ($data as $category){
            $selectedCategory[] = $category['my_bl_internet_offers_category_id'];
        }

        return $selectedCategory;
    }

    public function upSert($product_code, $categorys){

        MyBlProductTab::Where('product_code', $product_code)->Where('platform', 'al')->delete();

       if(!is_null($categorys)) {
           foreach ($categorys as $category) {
               $data ['product_code'] = $product_code;
               $data ['platform'] = 'al';
               $data ['my_bl_internet_offers_category_id'] = $category;

               MyBlProductTab::create($data);
           }
       }
    }

    public function findCategoryIdBySlugs($slugs){

        return MyBlInternetOffersCategory::whereIn('slug', $slugs)->where('platform', 'al')->pluck('id');
    }

}

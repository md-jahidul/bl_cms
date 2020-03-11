<?php

namespace App\Services;

use App\Enums\OfferType;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Repositories\ProductCoreRepository;
use App\Repositories\ProductDetailRepository;
use App\Repositories\ProductRepository;
use App\Repositories\SearchDataRepository;
use App\Repositories\TagCategoryRepository;
use App\Traits\CrudTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProductService {

    use CrudTrait;

    /**
     * @var $partnerOfferRepository
     */
    protected $productRepository;
    protected $productCoreRepository;
    protected $productDetailRepository;
    protected $searchRepository;
    protected $tagRepository;

    /**
     * ProductService constructor.
     * @param ProductRepository $productRepository
     * @param ProductDetailRepository $productDetailRepository
     * @param ProductCoreRepository $productCoreRepository
     * @param SearchDataRepository $searchRepository
     * @param TagCategoryRepository $tagRepository
     */
    public function __construct(
    ProductRepository $productRepository, ProductDetailRepository $productDetailRepository,
            ProductCoreRepository $productCoreRepository, SearchDataRepository $searchRepository, TagCategoryRepository $tagRepository
    ) {
        $this->productRepository = $productRepository;
        $this->productCoreRepository = $productCoreRepository;
        $this->productDetailRepository = $productDetailRepository;
        $this->searchRepository = $searchRepository;
        $this->tagRepository = $tagRepository;
        $this->setActionRepository($productRepository);
    }

    /**
     * @param $data
     * @param $simId
     * @return Response
     */
    public function storeProduct($data, $simId) {
        $data['sim_category_id'] = $simId;
        $data['product_code'] = str_replace(' ', '', strtoupper($data['product_code']));
        $product = $this->save($data);

        //save Search Data
        $this->_saveSearchData($product);

        $this->productDetailRepository->insertProductDetail($product->id);
        return new Response('Product added successfully');
    }

    //save Search Data
    private function _saveSearchData($product) {
        
        $productId = $product->id;
        $name = $product->name_en;
        
        $url = "";
        $type = "";
        if($product->sim_category_id == 1 && $product->offer_category_id == 1){
            $url = 'prepaid/internet-offer/' . $productId;
            $type = 'prepaid-internet';
        }
        if($product->sim_category_id == 1 && $product->offer_category_id == 2){
            $url = 'prepaid/voice-offer/' . $productId;
            $type = 'prepaid-voice';
        }
        if($product->sim_category_id == 1 && $product->offer_category_id == 3){
            $url = 'prepaid/bundle-offer/' . $productId;
            $type = 'prepaid-bundle';
        }
        if($product->sim_category_id == 2 && $product->offer_category_id == 1){
            $url = 'postpaid/internet-offer/' . $productId;
            $type ='postpaid-internet';
        }
        
        $tag = $this->tagRepository->getTagById($product->tag_category_id);
            
        return $this->searchRepository->saveData($productId, $name, $url, $type, $tag);
    }

    public function tableSortable($data) {
        $this->productRepository->productOfferTableSort($data);
        return new Response('update successfully');
    }

    /**
     * @param $type
     * @param $id
     * @return mixed
     */
    public function findRelatedProduct($type, $id) {
        return $this->productRepository->relatedProducts($type, $id);
    }

    /**
     * @param $data
     * @param $id
     * @return ResponseFactory|Response
     */
    public function updateProduct($data, $type, $id) {
        $product = $this->productRepository->findByCode($type, $id);
        $data['show_in_home'] = (isset($data['show_in_home']) ? 1 : 0);
        $product->update($data);
        //save Search Data
        $this->_saveSearchData($product);
        return Response('Product update successfully !');
    }

    /**
     * @param $type
     * @param $id
     * @return mixed
     */
    public function findProduct($type, $id) {
        return $this->productRepository->findByCode($type, $id);
    }

    public function detailsProduct($id) {
        return $this->productRepository->productDetails($id);
    }

    /**
     * @param $id
     * @return ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteProduct($id) {
        $product = $this->findOne($id);
        $product->delete();
        return Response('Product delete successfully');
    }

    public function unusedProductCore() {
        $productCoreCode = $this->productCoreRepository->findByProperties([], ['product_code'])->toArray();
        $productCode = $this->productRepository->findByProperties([], ['product_code'])->toArray();
        $unusedProductCode = [];
        foreach ($productCoreCode as $key => $product) {
            if (!in_array($product, $productCode)) {
                array_push($unusedProductCode, $product);
            }
        }
        return $unusedProductCode;
    }

    /**
     * @param $data
     * @param $offerId
     * Mapping Product Core Data to Product and insert
     * @param null $offerInfo
     */
    public function insertProduct($data, $offerId, $offerInfo = null) {
        $product = Product::updateOrCreate(
                        ['product_code' => $data['product_code'] ?? null,], [
                    'name_en' => $data['commercial_name_en'] ?? "",
                    'name_bn' => $data['commercial_name_bn'] ?? "",
                    'ussd_bn' => $data['activation_ussd'] ?? null,
                    'start_date' => "2019-12-10 20:12:10" ?? null,
                    'sim_category_id' => $data['sim_type'] ?? null,
                    'offer_category_id' => $offerId ?? null,
                    'is_recharge' => $data['is_recharge_offer'] ?? 0,
                    'status' => $data['status'],
                    'purchase_option' => $data['purchase_option'],
                    'offer_info' => $offerInfo
                        ]
        );

        ProductDetail::updateOrCreate(
                ['product_id' => $product->id]
        );
    }

    /**
     * @return mixed
     */
    public function findBondhoSim() {
        return $this->productRepository->countBondhoSimOffer();
    }

    /**
     * @param $coreProduct
     * Check Offer Type and separate product insert method call
     */
    public function getOfferInfo($coreProduct) {
        $type = $coreProduct->assetlite_offer_type;
        switch (strtolower($type)) {
            case 'internet':
                $offerId = 1; // Internet Offer
                $this->insertProduct($coreProduct, $offerId);
                break;
            case 'voice':
                $offerId = 2; // Voice Offer
                $this->insertProduct($coreProduct, $offerId);
                break;
            case 'bundle':
                $offerId = 3; // Bundle Offer
                $this->insertProduct($coreProduct, $offerId);
                break;
            case 'startup':
                $offerId = 4; // Startup Offer
                $this->insertProduct($coreProduct, $offerId, ['package_offer_type_id' => 6]);
                break;
//            default:
//                $offerId = null; // Bundle Offer
//                $this->insertProduct($coreProduct, $offerId);
        }
    }

    public function coreData() {
        $coreData = $this->productCoreRepository->findAll();
        foreach ($coreData as $coreProduct) {
            $this->getOfferInfo($coreProduct);
        }
        return "Insert Success";
    }

}

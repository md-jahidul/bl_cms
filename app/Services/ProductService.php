<?php

namespace App\Services;

use App\Enums\OfferType;
use App\Models\Product;
use App\Models\ProductCore;
use App\Models\ProductDetail;
use App\Repositories\AlCoreProductRepository;
use App\Repositories\DynamicRouteRepository;
use App\Repositories\ProductCoreRepository;
use App\Repositories\ProductDetailRepository;
use App\Repositories\ProductRepository;
use App\Repositories\SearchDataRepository;
use App\Repositories\TagCategoryRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProductService
{

    use CrudTrait;
    use FileTrait;

    /**
     * @var $partnerOfferRepository
     */
    protected $productRepository;
    protected $productCoreRepository;
    protected $productDetailRepository;
    protected $searchRepository;
    protected $tagRepository;
    /**
     * @var DynamicRouteRepository
     */
    private $dynamicRouteRepository;
    /**
     * @var DynamicUrlRedirectionService
     */
    private $dynamicUrlRedirectionService;
    /**
     * @var AlCoreProductRepository
     */
    private $alCoreProductRepository;

    /**
     * ProductService constructor.
     * @param ProductRepository $productRepository
     * @param ProductDetailRepository $productDetailRepository
     * @param ProductCoreRepository $productCoreRepository
     * @param SearchDataRepository $searchRepository
     * @param TagCategoryRepository $tagRepository
     * @param DynamicRouteRepository $dynamicRouteRepository
     * @param DynamicUrlRedirectionService $dynamicUrlRedirectionService
     */
    public function __construct(
        ProductRepository $productRepository,
        ProductDetailRepository $productDetailRepository,
        ProductCoreRepository $productCoreRepository,
        SearchDataRepository $searchRepository,
        TagCategoryRepository $tagRepository,
        DynamicRouteRepository $dynamicRouteRepository,
        DynamicUrlRedirectionService $dynamicUrlRedirectionService,
        AlCoreProductRepository $alCoreProductRepository
    ) {
        $this->productRepository = $productRepository;
        $this->productCoreRepository = $productCoreRepository;
        $this->productDetailRepository = $productDetailRepository;
        $this->alCoreProductRepository = $alCoreProductRepository;
        $this->searchRepository = $searchRepository;
        $this->tagRepository = $tagRepository;
        $this->setActionRepository($productRepository);
        $this->dynamicRouteRepository = $dynamicRouteRepository;
        $this->dynamicUrlRedirectionService = $dynamicUrlRedirectionService;
    }

    public function produtcs()
    {
        return $this->productRepository->findByProperties([], ['id', 'product_code', 'name_en']);
    }

    /**
     * @param $data
     * @param $simId
     * @return Response
     */
    public function storeProduct($data, $simId)
    {
        DB::beginTransaction();
        try {
            foreach ($data['offer_info'] as $key => $offerInfo) {
                if ($offerInfo) {
                    $otherInfo[$key] = $offerInfo;
                }
            }

            if (request()->hasFile('product_image')) {
                $data['product_image'] = $this->upload($data['product_image'], 'assetlite/images/product');
            }

            $data['offer_info'] = isset($otherInfo) ? $otherInfo : null;
            $data['sim_category_id'] = $simId;
            $data['created_by'] = Auth::id();
            $data['product_code'] = str_replace(' ', '', strtoupper($data['product_code']));

            #Image store
            if (request()->hasFile('image')) {

                $data['image'] = $this->upload($data['image'], 'assetlite/images/products');
            }

            $product = $this->save($data);

            /**
             * save Search Data
             * If product is in offer category: internet, voice, bundles
             */

//            $internate_voice_bundles = [1,2,3];
//
//            if (in_array($product->offer_category_id, $internate_voice_bundles)) {
//            }
            $this->_saveSearchData($product, 'create');

            $this->productDetailRepository->saveOrUpdateProductDetail($product->id);
            DB::commit();
            return new Response('Product added successfully');

        } catch (\Exception $e) {
            DB::rollback();
            return new Response($e->getMessage());
        }
    }

    //save Search Data
    private function _saveSearchData($product, $requestType)
    {
        $titleEn = $product->name_en;
        $titleBn = $product->name_bn;

        $productCode = null;
        #Product Code
        if ($product->offer_category->alias != "others"){
            $productCode = $product->product_code;
        }

        #Search Table Status
        $status = $product->status;

        $urlEn = "";
        $urlBn = "";
        if ($product->sim_category_id == 1) {
            $urlEn .= "prepaid/";
            $urlBn .= "prepaid/";
        }
        if ($product->sim_category_id == 2) {
            $urlEn .= "postpaid/";
            $urlBn .= "postpaid/";
        }

        //category url
        $urlEn .= $product->offer_category->url_slug;
        $urlBn .= $product->offer_category->url_slug_bn;
        $urlEn .= '/' . $product->url_slug;
        $urlBn .= '/' . $product->url_slug_bn;

        $saveSearchData = [
            'product_code' => $productCode,
            'type' => 'offer-product',
            'page_title_en' => $titleEn,
            'page_title_bn' => $titleBn,
            'url_slug_en' => $urlEn,
            'url_slug_bn' => $urlBn,
            'status' => $status,
        ];

        if ($requestType == "create") {
            $product->searchableFeature()->create($saveSearchData);
        }else {
            $product->searchableFeature()->update($saveSearchData);
        }
    }

    public function tableSortable($data)
    {
        $this->productRepository->productOfferTableSort($data);
        return new Response('update successfully');
    }

    /**
     * @param $type
     * @param $id
     * @return mixed
     */
    public function findRelatedProduct($type, $id)
    {
        return $this->productRepository->relatedProducts($type, $id);
    }

    /**
     * @param $data
     * @param $id
     * @return ResponseFactory|Response
     */
    public function updateProduct($data, $type, $id)
    {
        $product = $this->productRepository->findByCode($type, $id);

        /**
         * Checking URL slugs and generating dynamic url redirection accordingly
         */
        if (!empty($data['url_slug']) && $product->url_slug !== $data['url_slug']) {
            $urlPrefix = $this->generateProductUrlPrefix($product);
            $from = $urlPrefix . $product->url_slug;
            $to = $urlPrefix . $data['url_slug'];
            $this->addUrlRedirection($from, $to, $product->product_code);
        }
        if (!empty($data['url_slug_bn']) && $product->url_slug_bn !== $data['url_slug_bn']) {
            $urlPrefix = $this->generateProductUrlPrefix($product, 'bn');
            $from = $urlPrefix . $product->url_slug_bn;
            $to = $urlPrefix . $data['url_slug_bn'];
            $this->addUrlRedirection($from, $to, $product->product_code);
        }

        if (request()->hasFile('product_image')) {
            $data['product_image'] = $this->upload($data['product_image'], 'assetlite/images/product');
            $this->deleteFile($product->product_image);
        }

//        $this->productDetailRepository->saveOrUpdateProductDetail($product->id, $data);
        $data['show_in_home'] = (isset($data['show_in_home']) ? 1 : 0);
        $data['special_product'] = (isset($data['special_product']) ? 1 : 0);
        $data['rate_cutter_offer'] = (isset($data['rate_cutter_offer']) ? 1 : 0);
        $data['is_four_g_offer'] = (isset($data['is_four_g_offer']) ? 1 : 0);
        $data['updated_by'] = Auth::id();
        $data['product_code'] = strtoupper($data['product_code']);

        if(isset($data['validity_unit'])){

            $data['validity_postpaid'] = ($data['validity_unit'] == "bill_period") ? "Bill period" : null;
        }
        else{
            $data['validity_postpaid'] = null;
        }

        #Image Update
        if (request()->hasFile('image')) {

            $data['image'] = $this->upload($data['image'], 'assetlite/images/products');
            $this->deleteFile($product->image);
        }

        $product->update($data);

        //save Search Data
        $this->_saveSearchData($product, 'update');
        return Response('Product update successfully !');
    }

    /**
     * Generates URL prefix
     * @param $product
     * @param string $lang
     * @return string
     */
    public function generateProductUrlPrefix($product, $lang = 'en'): string
    {
        /**
         * Fetching prefix from dynamic route
         */
        $dynamicRoutes = optional($this->dynamicRouteRepository->findByProperties([
            'key' => $product->sim_category->alias ?? '',
            'status' => 1
        ]))->filter(function ($item) use ($lang) {
            $langInSlug = explode('/', $item->url);
            return in_array($lang, $langInSlug);
        })->first();

        $langUrlSlug = $lang === 'bn' ? 'url_slug_bn' : 'url_slug';

        return $dynamicRoutes->url . '/' . $product->offer_category->$langUrlSlug . '/';
    }

    /**
     * Adds a URL redirection in DB after checking if the from url is not already exists
     * @param $from
     * @param $to
     * @param $identifier
     */
    public function addUrlRedirection($from, $to, $identifier): void
    {
        if (!$this->dynamicUrlRedirectionService->ifRedirectionExist($from)) {
            $urlRedirectionData = [
                'title' => 'Redirection for OLD url for Product: ' . $identifier,
                'redirection_for' => 'product',
                'identifier' => $identifier,
                'from_url' => $from,
                'to_url' => $to,
                'status' => 1,
                'created_by' => Auth::id()
            ];

            $this->dynamicUrlRedirectionService->save($urlRedirectionData);
        }
    }

    /**
     * @param $type
     * @param $id
     * @return mixed
     */
    public function findProduct($type, $id)
    {
        return $this->productRepository->findByCode($type, $id);
    }

    public function detailsProduct($id)
    {
        return $this->productRepository->productDetails($id);
    }

    /**
     * @param $id
     * @return ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteProduct($id)
    {
        $product = $this->findOne($id);
        if ($product) {
            $this->alCoreProductRepository->findOneByProperties(['product_code' => $product->product_code])->delete();
        }
        $product->delete();
        $product->searchableFeature()->delete();
        return Response('Product delete successfully');
    }

    public function unusedProductCore($type)
    {
        $simType = $type == "prepaid" ? 1 : 2;
        $productCoreCode = $this->productCoreRepository->findByProperties(['sim_type' => $simType],
            ['product_code'])->toArray();
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
    public function insertProduct($data, $offerId, $offerInfo = null)
    {
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
    public function findBondhoSim()
    {
        return $this->productRepository->countBondhoSimOffer();
    }

    /**
     * @param $coreProduct
     * Check Offer Type and separate product insert method call
     */
    public function getOfferInfo($coreProduct)
    {
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

    public function coreData()
    {
        $coreData = $this->productCoreRepository->findAll();
        foreach ($coreData as $coreProduct) {
            $this->getOfferInfo($coreProduct);
        }
        return "Insert Success";
    }

    public function getInternetVolumeByProductCode($productCode)
    {
        $product = ProductCore::whereHas(
            'blProduct',
            function ($q) use ($productCode) {
                $q->where('status', 1);
            }
        )->with('blProduct')->where('product_code', $productCode)->first();

        if (!$product) {
            return false;
        }

        return $product->internet_volume_mb;
    }

    public function updateSearchData($product){

        /**
         * save Search Data
         * If product is in offer category: internet, voice, bundles
         */

        $internate_voice_bundles = [1,2,3];
        $response = '';

        if (in_array($product->offer_category_id, $internate_voice_bundles)) {
            $response = $this->_saveSearchData($product);
        }
        return $response;
    }

}

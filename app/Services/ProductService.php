<?php

namespace App\Services;

use App\Enums\OfferType;
use App\Models\AlCoreProduct;
use App\Models\MyBlInternetOffersCategory;
use App\Models\MyBlProductTab;
use App\Models\OfferCategory;
use App\Models\Product;
use App\Models\ProductCore;
use App\Models\ProductDetail;
use App\Models\TagCategory;
use App\Repositories\DynamicRouteRepository;
use App\Repositories\ProductCoreRepository;
use App\Repositories\ProductDetailRepository;
use App\Repositories\ProductRepository;
use App\Repositories\SearchDataRepository;
use App\Repositories\TagCategoryRepository;
use App\Traits\CrudTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;
use Box\Spout\Common\Entity\Style\Color;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Box\Spout\Reader\Common\Creator\ReaderFactory;
use Exception;
use Illuminate\Support\Arr;
use Box\Spout\Common\Type;
use Illuminate\Support\Facades\Validator;

class ProductService
{

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
     * @var DynamicRouteRepository
     */
    private $dynamicRouteRepository;
    /**
     * @var DynamicUrlRedirectionService
     */
    private $dynamicUrlRedirectionService;

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
        DynamicUrlRedirectionService $dynamicUrlRedirectionService
    ) {
        $this->productRepository = $productRepository;
        $this->productCoreRepository = $productCoreRepository;
        $this->productDetailRepository = $productDetailRepository;
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
        foreach ($data['offer_info'] as $key => $offerInfo) {
            if ($offerInfo) {
                $otherInfo[$key] = $offerInfo;
            }
        }
        $data['offer_info'] = isset($otherInfo) ? $otherInfo : null;
        $data['sim_category_id'] = $simId;
        $data['created_by'] = Auth::id();
        $data['product_code'] = str_replace(' ', '', strtoupper($data['product_code']));
        $product = $this->save($data);
        //save Search Data
        $this->_saveSearchData($product);
        $this->productDetailRepository->saveOrUpdateProductDetail($product->id);
        return new Response('Product added successfully');
    }

    //save Search Data
    private function _saveSearchData($product)
    {
        $productId = $product->id;
        $name = $product->name_en;

        $url = "";
        if ($product->sim_category_id == 1) {
            $url .= "prepaid/";
        }
        if ($product->sim_category_id == 2) {
            $url .= "postpaid/";
        }

        //category url
        $url .= $product->offer_category->url_slug;

        $keywordType = "offer-" . $product->offer_category->alias;


        $type = "";
        if ($product->sim_category_id == 1 && $product->offer_category_id == 1) {
            $url .= '/' . $product->url_slug . '/' . $productId;
            $type = 'prepaid-internet';
        }
        if ($product->sim_category_id == 1 && $product->offer_category_id == 2) {
            $url .= '/' . $product->url_slug . '/' . $productId;
            $type = 'prepaid-voice';
        }
        if ($product->sim_category_id == 1 && $product->offer_category_id == 3) {
            $url .= '/' . $product->url_slug . '/' . $productId;
            $type = 'prepaid-bundle';
        }
        if ($product->sim_category_id == 2 && $product->offer_category_id == 1) {
            $url .= '/' . $product->url_slug . '/' . $productId;
            $type = 'postpaid-internet';
        }
        if ($product->offer_category_id > 3) {
            $url .= '/' . $product->url_slug . '/' . $productId;
            $type = 'others';
        }

        $tag = "";
        if ($product->tag_category_id) {
            $tag = $this->tagRepository->getTagById($product->tag_category_id);
        }

        return $this->searchRepository->saveData($productId, $keywordType, $name, $url, $type, $tag);
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
        
        $product->update($data);

        //save Search Data
        $this->_saveSearchData($product);
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
        $product->delete();
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

    /**
     * @param Request $request
     * @return array
     */
    public function getOffersProducts(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');

        $builder = new Product();
        $builder = $builder->where('status', 1);
        $builder = $builder->latest();
        /*        if ($request->status) {
          $builder = MyBlProduct::where('status', $request->status);
          } */
        if ($request->show_in_home != null) {
            $builder = $builder->where('show_in_home', $request->show_in_home);
        }
        if ($request->name_en != null) {
            $builder = $builder->where('name_en','LIKE', '%'.$request->name_en.'%');
        }

        // if ($request->pinned_products != "") {
        //     $builder = $builder->where('pin_to_top', $request->pinned_products);
        // }

        #shuvo: need clarification
        // $bundles = ['mix', 'voice', 'sms'];
        $bundles = ['internet', 'voice', 'bundles', 'data', 'mix'];

        $builder = $builder->whereHas(
            'product_core',
            function ($q) use ($request, $bundles) {
                if ($request->product_code) {
                    $q->where('product_code', $request->product_code);
                }
                if ($request->sim_type) {
                    $q->where('sim_type', $request->sim_type);
                }

                if ($request->content_type) {

                    #If request content type is internet it need to convert to data. Because in AlCoreProductService it store as data
                    if ($request->content_type == 'internet') $request->content_type = 'data';
                    if ($request->content_type == 'bundles') $request->content_type = 'mix';
               

                    if (in_array($request->content_type, $bundles)) {
                        $q->where('content_type', $request->content_type);
                        $q->whereNull('call_rate');
                    } elseif ($request->content_type == 'recharge_offer') {
                        $q->whereNotNull('recharge_product_code');
                    } elseif ($request->content_type == 'scr') {
                        $q->whereNotNull('call_rate');
                    } elseif ($request->content_type == 'free_products') {
                        $q->where('mrp_price', null);
                    } else {
                        $q->where('content_type', $request->content_type);
                    }
                }
            }
        )->with(['sim_category', 'offer_category', 'product_core']);

        // if ($request->content_type == 'is_popular_pack') {
        //     $builder =  $builder->where('is_popular_pack', 1);
        // }

        // if ($request->content_type == 'recharge_offer') {
        //     $builder->where('show_recharge_offer', 1);
        // }

        $all_items_count = $builder->count();
        $items = $builder->skip($start)->take($length)->get();

        $response = [
            'draw' => $draw,
            'recordsTotal' => $all_items_count,
            'recordsFiltered' => $all_items_count,
            'data' => []
        ];

        $items->each(function ($item) use (&$response) {
            // $activeSchedule = $item->scheduleStatus() ? config('productMapping.mybl.product_schedule_statuses.'
            //     . $item->scheduleStatus()) : 'Shown';
            // $link = $this->productDeepLinkRepository->findOneProductLink($item->product_code);
            $link = null;

            /**
             * For Details Url 
             */
            $details_url = '';
            if(strtolower( $item->offer_category->name_en) == "others" || $item->sim_category->alias == 'postpaid' && $item->offer_category->name_en == 'Packages')
            {

                $details_url = '<a href="'.route('section-list', [$item->sim_category->alias, $item->id]).'" class="btn-sm btn-outline-primary border">Details</a>';
            }
            else{
                $details_url = '<a href="'.route('product.details', [strtolower($item->sim_category->alias), $item->product_code, strtolower( $item->offer_category->name_en)]).'" class="btn-sm btn-outline-primary border">Details</a>';
            }
            


            $response['data'][] = [
                'product_code' => $item->product_code,
                // 'pin_to_top' => $item->pin_to_top,
                'name_en' => $item->name_en,
                'activation_ussd' => $item->product_core->activation_ussd,
                'offer_category' => $item->offer_category->name_en,
                'connection_type' => $item->sim_category->name,
                'connection_type_alias' => $item->sim_category->alias,
                // 'name' => $item->product_core->name,
                'details' => $details_url,
                'content_type' => ucfirst($item->product_core->content_type),
                // 'family_name' => ucfirst($item->product_core->family_name),
                // 'offer_section' => ucfirst($item->offer_section_title),
                'show_in_home' => ($item->show_in_home) ? 'Yes' : 'No',
                'media' => ($item->image) ? 'Yes' : 'No',
                'status' => $item->product_core->status,
                // 'is_visible' => $item->is_visible ? $activeSchedule : 'Hidden',
                // 'show_from' => $item->show_from ? Carbon::parse($item->show_from)->format('d-m-Y h:i A') : '',
                // 'hide_from' => $item->hide_from ? Carbon::parse($item->hide_from)->format('d-m-Y h:i A') : '',
                // 'deep_link' => !empty($link->deep_link) ? $link->deep_link : null,
                'action' => ['edit' => route('product.edit', [strtolower($item->sim_category->alias), $item->product_code])],

            ];
        });
        return $response;
    }


    
    public function downloadOffersProducts()
    {
        $products = Product::whereHas('product_core')->with(['sim_category:id,name,alias', 'offer_category:id,name_en,alias', 'tag_category', 'product_core', 'product_details'])->where('status', 1)->get();
        // $products = Product::whereHas('product_core')->with(['sim_category:id,name,alias', 'offer_category:id,name_en,alias', 'product_core', 'product_details'])->where('status', 1)->first();

        $products = $products->sortBy('product_core.content_type');

        $writer = WriterEntityFactory::createXLSXWriter();

        $writer->openToBrowser('active-offers-products-' . date('Y-m-d') . '.xlsx');

        // header Style
        $header_style = (new StyleBuilder())
            ->setFontBold()
            ->setFontSize(11)
            ->setBackgroundColor(Color::rgb(245, 245, 240))
            ->build();

        $data_style = (new StyleBuilder())
            ->setFontSize(9)
            ->build();


        $header = config('productMapping.assetlite.columns');

        // unset($header['internet_volume_mb']);

        // $header['Active'] = $header['status'];
        // unset($header['status']);

        $headers = array_map(function ($val) {
            return str_replace('_', ' ', ucwords($val));
        }, array_keys($header));

        // array_pop($headers);

        $row = WriterEntityFactory::createRowFromArray(array_values($headers), $header_style);
        $writer->addRow($row);

        $problem = [];

        foreach ($products as $product) {
            if ($product->product_core) {
                $insert_data[0] = $product->sim_category->name;
                $insert_data[1] = $product->product_core->content_type;
                $insert_data[2] = $product->product_core->product_code;
                $insert_data[3] = $product->product_core->recharge_product_code;
                $insert_data[4] = $product->product_core->renew_product_code;
                $insert_data[5] = $product->product_core->commercial_name_en;
                $insert_data[6] = $product->product_core->commercial_name_bn;
                $insert_data[7] = $product->product_core->activation_ussd;
                $insert_data[8] = $product->product_core->balance_check_ussd;
                $insert_data[9] = $product->product_core->mrp_price;
                $insert_data[10] = $product->product_core->price;
                $insert_data[11] = $product->product_core->vat;
                $insert_data[12] = $product->product_core->validity;
                $insert_data[13] = $product->product_core->validity_unit;
                $insert_data[14] = $product->product_core->data_volume_unit;
                $insert_data[15] = $product->product_core->data_volume;
                $insert_data[16] = $product->product_core->internet_volume_mb;
                $insert_data[17] = $product->product_core->sms_volume;
                $insert_data[18] = $product->product_core->call_rate;
                $insert_data[19] = $product->product_core->call_rate_unit;
                
                $insert_data[20] = $product->product_core->minute_volume;
                $insert_data[21] = $product->product_core->validity_in_days;
                $insert_data[22] = ($product->special_product) ? 'Yes' : 'No';
                $insert_data[23] = ($product->rate_cutter_offer) ? 'Yes' : 'No';
                $insert_data[24] = ($product->is_four_g_offer) ? 'Yes' : 'No';
                $insert_data[25] = $product->product_core->sd_vat_tax_en;
                $insert_data[26] = $product->product_core->sd_vat_tax_bn;
                $insert_data[27] = ($product->show_in_home) ? 'Yes' : 'No';
                $insert_data[28] = $product->product_core->short_description;
                $insert_data[29] = $product->tag_category->name_en ?? '';
                $insert_data[30] = implode(',', $product->detailTabs->pluck('name')->toArray()) ?? '';

                $insert_data[31] = $product->product_core->name;
                $insert_data[32] = $product->url_slug;
                $insert_data[33] = $product->url_slug_bn;
                $insert_data[34] = $product->start_date;
                $insert_data[35] = $product->end_date;

                $row = WriterEntityFactory::createRowFromArray($insert_data, $data_style);

                $writer->addRow($row);
            } else {
                $problem [] = $product->product_code;
            }
        }

        if (count($problem)) {
            Log::info(json_encode($problem));
        }
        $writer->close();
    }

    /**
     * @param $excel_path
     * @return bool|int
     */
    public function mapOffersProduct($excel_path)
    {
        $config = config('productMapping.assetlite.columns');
        $offers = OfferCategory::where('parent_id', 0)->pluck('id', 'alias')->toArray();
        $tags = TagCategory::pluck('id', 'name_en')->toArray();
        $familyGroups = MyBlInternetOffersCategory::where('platform', 'al')->pluck('id', 'name')->toArray();

        #Offer Types
        $types = ['internet', 'voice', 'bundles', 'data', 'mix'];

        try {
            $reader = ReaderFactory::createFromType(Type::XLSX); // for XLSX files
            $file_path = $excel_path;
            $reader->open($file_path);

            foreach ($reader->getSheetIterator() as $sheet) {
                $row_number = 1;
                foreach ($sheet->getRowIterator() as $row) {
                    $core_data = [];
                    // $mybl_data = [];
                    $product_data = [];
                    $productTabs = [];
                    // $tags = [];
                    $errors = [];

                    if ($row_number != 1) {
                        $cells = $row->getCells();
                        foreach ($config as $field => $index) {
                            switch ($field) {
                                case "content_type":
                                    $content_type_request = ($cells [$index]->getValue() != '') ? strtolower($cells [$index]->getValue()) : null;
                                    $core_data [$field] = $content_type_request;

                                    if (in_array($content_type_request, $types) && $content_type_request != null) {

                                        #If request content type is internet it need to convert to data. Because in AlCoreProductService it store as data
                                        $offer_content_type = $content_type_request;

                                        if($content_type_request == 'data'){
                                            $offer_content_type = 'internet';
                                        }elseif($content_type_request == 'mix'){
                                            $offer_content_type = 'bundles';
                                        };


                                        #For Products table 
                                        $product_data['offer_category_id'] =  ($cells [$index]->getValue() != '') ? $offers[$offer_content_type] : 0;
                                    }else{

                                        Log::error('Error: Row no.' . $row_number . ' '. 'Content Type Messing');
                                        $errors[] = ['Error: Row no.' . $row_number . ' '. 'Content Type Messing'];
                                    }

                                    break;

                                case "sim_type":
                                    $type = strtolower($cells [$index]->getValue());
                                    if ($type == 'prepaid') {
                                        $sim_type = 1;
                                    } elseif ($type == 'postpaid') {
                                        $sim_type = 2;
                                    } elseif ($type == 'propaid') {
                                        $sim_type = 3;
                                    } else {
                                        $sim_type = 4;
                                    }
                                    $core_data [$field] = $sim_type;
                                    
                                    #For Products table 
                                    $product_data['sim_category_id'] = $sim_type;

                                    break;
                                case 'commercial_name_en':
                                    $name = $cells [$index]->getValue();

                                    $core_data ['name'] = $name;
                                    $core_data [$field] = $name;
                                    $product_data['name_en'] = $name;

                                    break;
                                case 'commercial_name_bn':
                                    $name_bn = $cells [$index]->getValue();
                                    $core_data [$field] = $name_bn;
                                    
                                    $product_data['name_bn'] = $name_bn;

                                    break;
                                case 'status':
                                case 'is_visible':
                                case "is_rate_cutter_offer":
                                case "show_recharge_offer":
                                    $type = strtolower($cells [$index]->getValue());
                                    if ($type == 'yes') {
                                        $flag = 1;
                                    } elseif ($type == 'no') {
                                        $flag = 0;
                                    } else {
                                        break;
                                    }
                                    $product_data[$field] = $flag;
                                    break;
                                case "internet_volume_mb":
                                    $data_volume = $cells [$index]->getValue();

                                    if ($data_volume == '') {
                                        $data_volume = 0;
                                    }
                                    $data_unit = $cells [$index + 1]->getValue();
                                    if ($data_unit == 'GB') {
                                        $volume = $data_volume * 1024;
                                        $core_data [$field] = $volume;
                                    } else {
                                        $core_data [$field] = $data_volume;
                                    }
                                    break;
                                case "data_volume":
                                    $data_volume = $cells [$index]->getValue();

                                    if ($data_volume == '') {
                                        $data_volume = 0;
                                    }
                                    $core_data [$field] = $data_volume;
                                    break;
                                case "sms_volume":
                                case "minute_volume":
                                    $volume = $cells [$index]->getValue();
                                    if ($volume == '') {
                                        $volume = 0;
                                    }
                                    $core_data [$field] = $volume;
                                    break;
                                case "internet_volume_unit":
                                    $data_volume_unit = $cells [$index]->getValue();
                                    $core_data [$field] = $data_volume_unit;
                                    break;
                                case "validity_in_days":
                                    $validity = $cells [$config['validity']]->getValue();
                                    $unit = $cells [$config['validity_unit']]->getValue();

                                    if (strtolower($unit) == 'hours') {
                                        $validity = round($validity / 24);
                                    }
                                    $core_data [$field] = ($validity == "") ? null : $validity;
                                    break;
                                #shuvo: offer_section_title is not in table. Maybe need to work for Product Category here (Done)

                                case "family_group":
                                    $title = $cells [$index]->getValue();
                                    if ($title != '') {
                                        $titleArr = explode(',', $title);
                                        #Need to work here for new MyBlInternetOffersCategory if not exist (Done)
                                        // $product_data[$field] = $titleArr[0];
                                        // $product_data['offer_section_slug'] = str_replace(' ', '_',
                                        //     strtolower($titleArr[0]));

                                        foreach ($titleArr as $key => $singleTitle) {
                                            
                                            if (!array_key_exists($singleTitle, $familyGroups)) {
                                                $newFamilyGroup = MyBlInternetOffersCategory::create([
                                                    'name' => $singleTitle,
                                                    'slug' => str_replace(' ', '_',strtolower($singleTitle)),
                                                    'platform' => 'al',
                                                    'sort' => count($familyGroups) + 1,
                                                ]);

                                                $familyGroups[$newFamilyGroup->name] = $newFamilyGroup->id; 
                                            }
                                        }


                                        if (!is_null($core_data['content_type'])) {
                                            $productCode = $core_data['product_code'];
                                            $productTabs = MyBlInternetOffersCategory::select('id')
                                                ->whereIn('name', $titleArr)
                                                ->get()
                                                ->each(function ($item) use ($productCode) {
                                                    $item->product_code = $productCode;
                                                    $item->my_bl_internet_offers_category_id = $item->id;
                                                    unset($item->id);
                                                    return $item;
                                                })->toArray();
                                        }

                                    }
                                    break;
                                case "tag":

                                    $tag_request = ($cells [$index]->getValue() != '') ? trim($cells [$index]->getValue()) : "";

                                    if ($tag_request != "") {

                                        $tag_id = null;
    
                                        if (!array_key_exists($tag_request, $tags) && $tag_request != "") {
    
                                            $tagInsert = new TagCategory();
                                            $tagInsert->name_en = $tag_request;
                                            $tagInsert->name_bn = $tag_request;
                                            $tagInsert->tag_color = '#000000';
                                            $tagInsert->alias = str_replace(" ", "_", strtolower($tag_request));
                                            $tagInsert->save();
                                            $tag_id = $tagInsert->id;
                                        }
                                        elseif(isset($tags[$tag_request])){

                                            $tag_id = $tags[$tag_request];
                                        }
    
                                        $product_data['tag_category_id'] =  $tag_id;
                                    }


                                    break;

                                case "start_date":

                                    // if (!empty($cells[$index]->getValue())) {
                                    //     $time = Carbon::createFromFormat(
                                    //         'd-m-Y h:i A',
                                    //         $cells[$index]->getValue()
                                    //     )->format('Y-m-d H:i:s');
                                    // } else {
                                    //     $time = null;
                                    // }
                                    // $product_data[$field] = $time;

                                    // break;
                                case "end_date":
                                    // if (!empty($cells[$index]->getValue())) {
                                    //     $time = Carbon::createFromFormat(
                                    //         'd-m-Y h:i A',
                                    //         $cells[$index]->getValue()
                                    //     )->format('Y-m-d H:i:s');
                                    // } else {
                                    //     $time = null;
                                    // }
                                    // $product_data[$field] = $time;
                                    // break;
                                case "url_slug":
                                    $url = (!empty($cells[$index]->getValue())) ? $cells [$index]->getValue() : null;
                                    $product_data[$field] = $url;

                                    // $validator = Validator::make(['url_slug' => $url], [
                                    //     'url_slug' => 'required|regex:/^\S*$/u|unique:products,url_slug',
                                    // ]);

                                    // if ($validator->fails()) {
                                    //     Log::error('Error: Row no.' . $validator->messages()->first() . ' '. 'Content Type Messing');
                                    //     $errors[] = ['Error: Row no.' . $validator->messages()->first() . ' '. 'Content Type Messing'];
                                    // }else{

                                    //     $product_data[$field] = $url;
                                    // }


                                    

                                    break;
                                case "url_slug_bn":

                                    $url_bn = (!empty($cells[$index]->getValue())) ? $cells [$index]->getValue() : null;

                                    $product_data[$field] = $url_bn;

                                    // $validator = Validator::make(['url_slug_bn' => $url_bn], [
                                    //     'url_slug_bn' => 'required|regex:/^\S*$/u|unique:products,url_slug_bn'
                                    // ]);

                                    // if ($validator->fails()) {
                                    //     Log::error('Error: Row no.' . $validator->messages()->first() . ' '. 'Content Type Messing');
                                    //     $errors[] = ['Error: Row no.' . $validator->messages()->first() . ' '. 'Content Type Messing'];
                                    // }else{

                                    //     $product_data[$field] = $url_bn;
                                    // }

                                    break;
                                case "special_product":
                                    $type_r = strtolower($cells [$index]->getValue());

                                    if ($type_r == 'yes') {
                                        $type = 1;
                                    } else {
                                        $type = 0;
                                    }                                    
                                    #For Products table 
                                    $product_data['special_product'] = $type;

                                    break;
                                case "rate_cutter_offer":
                                    $type_r = strtolower($cells [$index]->getValue());

                                    if ($type_r == 'yes') {
                                        $type = 1;
                                    } else {
                                        $type = 0;
                                    }                                    
                                    #For Products table 
                                    $product_data['rate_cutter_offer'] = $type;

                                    break;
                                case "is_four_g_offer":
                                    $type_r = strtolower($cells [$index]->getValue());

                                    if ($type_r == 'yes') {
                                        $type = 1;
                                    } else {
                                        $type = 0;
                                    }                                    
                                    #For Products table 
                                    $product_data['is_four_g_offer'] = $type;

                                    break;
                                default:
                                    $core_data [$field] = ($cells [$index]->getValue() != '') ?
                                        $cells [$index]->getValue() : null;
                            }
                        }

                        try {

                            

                            $product_code = $core_data['product_code'];
                            $core_product = AlCoreProduct::where('product_code', $product_code)->first();
                            $al_product = Product::where('product_code', $product_code)->first();


                            if (empty($al_product)) {
                                $validator = Validator::make(['url_slug' => $product_data['url_slug'], 'url_slug_bn' => $product_data['url_slug_bn']], [
                                    'url_slug' => 'required|regex:/^\S*$/u|unique:products,url_slug',
                                    'url_slug_bn' => 'required|regex:/^\S*$/u|unique:products,url_slug_bn'
                                ]);
                            } else {
                                $validator = Validator::make(['url_slug' => $product_data['url_slug'], 'url_slug_bn' => $product_data['url_slug_bn']], [
                                    'url_slug' => 'required|regex:/^\S*$/u|unique:products,url_slug,'. $al_product->id,
                                    'url_slug_bn' => 'required|regex:/^\S*$/u|unique:products,url_slug_bn,'. $al_product->id,
                                ]);
                            }
                            

                            if ($validator->fails()) {
                                Log::error('Error: Row no.'. $row_number . ':' . $validator->messages()->first() . ' '. 'Content Type Messing');
                                $errors[] = ['Error: Row no.' . $row_number . ':'. $validator->messages()->first() . ' '. 'Content Type Messing'];
                            }

                            #shuvo: Need Confirmation
                            // if ($core_product) {
                            //     if ($core_product->platform == 'web') {
                            //         $core_data ['platform'] = 'all';
                            //     }
                            // } else {
                            //     $core_data['platform'] = 'app';
                            // }

                            if(count($errors) > 0 ) continue;

                            AlCoreProduct::updateOrCreate([
                                'product_code' => $product_code
                            ], $core_data);

                            $product = Product::updateOrCreate([
                                'product_code' => $product_code
                            ], $product_data);

                            /**
                             * For search table's keyword update
                             */

                            if(!empty($product)) $this->_saveSearchData($product);


                            #shuvo: Need to work for it (Done)
                            // print_r($productTabs);

                            if (count($productTabs)) {
                                MyBlProductTab::where('product_code', $product_code)->delete();

                                foreach ($productTabs as $productTab) {
                                    $productTabInsert = new MyBlProductTab();
                                    $productTabInsert->product_code = $productTab['product_code'];
                                    $productTabInsert->my_bl_internet_offers_category_id = $productTab['my_bl_internet_offers_category_id'];
                                    $productTabInsert->platform = 'al';
                                    $productTabInsert->save();
                                }
                            }

                            #shuvo: Need to work for it (No Need by this time)

                            // if (count($tags)) {
                            //     $existingTags = TagCategory::whereIn('name_en', $tags)->get();
                            //     $existingTagTitles = $existingTags->pluck('name_en')->toArray();
                            //     $existingTagIds = $existingTags->pluck('id')->toArray();

                            //     foreach ($tags as $tag) {
                            //         if (!in_array($tag, Arr::flatten($existingTagTitles)) && $tag != "") {
                            //             $tagInsert = new TagCategory();
                            //             $tagInsert->name_en = $tag;
                            //             $tagInsert->save();
                            //         }
                            //     }

                            //     $this->syncProductTags($product_code, Arr::flatten($existingTagIds));
                            // }

                        } catch (Exception $e) {
                            Log::error('Error: ' . $product_code . ' ' . $e->getMessage());
                            continue;
                        }
                    }
                    $row_number++;
                }
            }
            $reader->close();
            return true;
        } catch (Exception $e) {
            Log::error('Product Entry Error: ' . $e->getMessage());
            return 0;
        }
    }

}

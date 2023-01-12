<?php

namespace App\Services;

use App\Models\AlCoreProduct;
use App\Models\MyBlInternetOffersCategory;
use App\Models\MyBlProduct;
use App\Models\Product;
use App\Models\ProductCore;
use App\Models\ProductCoreHistory;
use App\Models\ProductDetail;
use App\Repositories\AlCoreProductRepository;
use App\Repositories\SearchDataRepository;
use App\Repositories\TagCategoryRepository;
use App\Services\Assetlite\AlInternetOffersCategoryService;
use App\Traits\CrudTrait;
use Box\Spout\Common\Entity\Style\Color;
use Box\Spout\Common\Type;
use Box\Spout\Reader\Common\Creator\ReaderFactory;
use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Writer\Common\Creator\WriterFactory;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

/**
 * Class AlCoreProductService
 * @package App\Services
 */
class AlCoreProductService
{
    use CrudTrait;

    /**
     * @var $partnerOfferRepository
     */
    protected $alCoreProductRepository;
    protected $searchRepository;
    protected $tagRepository;
    private $alInternetOffersCategoryService;

    /**
     * @var array
     */
    protected $config;

    /**
     * ProductCoreService constructor.
     * @param  AlCoreProductRepository  $alCoreProductRepository
     * @param  SearchDataRepository  $searchRepository
     * @param  TagCategoryRepository  $tagRepository
     */
    public function __construct(
        AlCoreProductRepository $alCoreProductRepository,
        SearchDataRepository $searchRepository,
        TagCategoryRepository $tagRepository,
        AlInternetOffersCategoryService $alInternetOffersCategoryService
    ) {
        $this->alCoreProductRepository = $alCoreProductRepository;
        $this->searchRepository = $searchRepository;
        $this->tagRepository = $tagRepository;
        $this->alInternetOffersCategoryService = $alInternetOffersCategoryService;
        $this->setActionRepository($alCoreProductRepository);
    }

    /**
     * @param $typeId
     * @return string
     */
    public function getType($typeId)
    {
        switch ($typeId) {
            case "1":
                $offerId = "data";
                break;
            case '2':
                $offerId = "voice";
                break;
            case '3':
                $offerId = "mix";
                break;
            default:
                $offerId = null;
        }
        return $offerId;
    }

    /**
     * @param $id
     * @return string|null
     */
    public function getSimtype($id)
    {
        switch ($id) {
            case "1":
                $type = "prepaid";
                break;
            case '2':
                $type = "postpaid";
                break;
            case '3':
                $type = "propaid";
                break;
            default:
                $type = null;
        }
        return $type;
    }

    /**
     * @param $data
     * @param $simId
     * @return void
     */
    public function storeProductCore($data, $simId)
    {
        $productCode = $this->alCoreProductRepository
            ->findByProperties(['product_code' => $data['product_code']])
            ->first();
        if (empty($productCode)) {
            $data['name'] = $data['name_en'];
            $data['product_code'] = str_replace(' ', '', strtoupper($data['product_code']));
            $data['recharge_product_code'] = isset($data['recharge_product_code']) ? str_replace(' ', '', strtoupper($data['recharge_product_code'])) : null;
            $data['renew_product_code'] = isset($data['renew_product_code']) ? str_replace(' ', '', strtoupper($data['renew_product_code'])) : null;
            $data['commercial_name_en'] = $data['name_en'];
            $data['commercial_name_bn'] = $data['name_bn'];
            $data['content_type'] = $this->getType($data['offer_category_id']);
            $data['sim_type'] = $simId;
            $this->save($data);
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findProductCore($id)
    {
        return $this->alCoreProductRepository->findWithProduct($id);
    }

    /**
     * @param $data
     * @param $id
     */
    public function updateProductCore($data, $id)
    {
        $product = $this->alCoreProductRepository->findOneProductCore($id);
    
        if (!$product) {
            $data['name'] = $data['name_en'];
            $data['product_code'] = strtoupper($data['product_code']);
            $data['recharge_product_code'] = isset($data['recharge_product_code']) ? str_replace(' ', '', strtoupper($data['recharge_product_code'])) : null;
            $data['renew_product_code'] = isset($data['renew_product_code']) ? str_replace(' ', '', strtoupper($data['renew_product_code'])) : null;
            $data['commercial_name_en'] = $data['name_en'];
            $data['commercial_name_bn'] = $data['name_bn'];
            $data['content_type'] = $this->getType($data['offer_category_id']);
            $data['sim_type'] = (strtolower($data['type']) == 'prepaid') ? 1 : 2;
            
            if(isset($data['validity_unit'])){
                
                $data['validity'] = ($data['validity_unit'] == "bill_period") ? null : $data['validity'];
            }
            else $data['validity'] = null;
            
            $this->save($data);
        } else {
            $data['product_code'] = strtoupper($data['product_code']);
            $data['recharge_product_code'] = isset($data['recharge_product_code']) ? str_replace(' ', '', strtoupper($data['recharge_product_code'])) : null;
            $data['renew_product_code'] = isset($data['renew_product_code']) ? str_replace(' ', '', strtoupper($data['renew_product_code'])) : null;
            $data['content_type'] = $this->getType($data['offer_category_id']);

            
            if(isset($data['validity_unit'])){

                $data['validity'] = ($data['validity_unit'] == "bill_period") ? null : $data['validity'];
            }
            else $data['validity'] = null;
            
            $product->update($data);
        }
    }

    /**
     * @param $excel_path
     * @return bool|int
     */
    public function mapMyBlProduct($excel_path)
    {
        $config = config('productMapping.mybl.columns');
        try {
            $reader = ReaderFactory::createFromType(Type::XLSX); // for XLSX files
            $file_path = $excel_path;
            $reader->open($file_path);

            foreach ($reader->getSheetIterator() as $sheet) {
                $row_number = 1;
                foreach ($sheet->getRowIterator() as $row) {
                    $core_data = [];
                    $mybl_data = [];
                    if ($row_number != 1) {
                        $cells = $row->getCells();
                        foreach ($config as $field => $index) {
                            switch ($field) {
                                case "content_type":
                                    $core_data [$field] = ($cells [$index]->getValue() != '') ?
                                        strtolower($cells [$index]->getValue()) : null;
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
                                    break;
                                case 'status':
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
                                    $mybl_data[$field] = $flag;
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
                                case "offer_section_title":
                                    $title = $cells [$index]->getValue();
                                    if ($title != '') {
                                        $mybl_data[$field] = $title;
                                        $mybl_data['offer_section_slug'] = str_replace(' ', '_', strtolower($title));
                                    }
                                    break;
                                case "tag":
                                    $tag = $cells [$index]->getValue();
                                    $mybl_data[$field] = $tag;
                                    break;

                                default:
                                    $core_data [$field] = ($cells [$index]->getValue() != '') ?
                                        $cells [$index]->getValue() : null;
                            }
                        }

                        try {
                            $product_code = $core_data['product_code'];
                            $core_product = AlCoreProduct::where('product_code', $product_code)->first();

                            if ($core_product) {
                                if ($core_product->platform == 'web') {
                                    $core_data ['platform'] = 'all';
                                }
                            } else {
                                $core_data['platform'] = 'app';
                            }

                            //dd($core_data);

                            AlCoreProduct::updateOrCreate([
                                'product_code' => $product_code
                            ], $core_data);

                            MyBlProduct::updateOrCreate([
                                'product_code' => $product_code
                            ], $mybl_data);
                        } catch (Exception $e) {
                            dd($e->getMessage());
                            continue;
                        }
                    }
                    $row_number++;
                }
            }
            $reader->close();
            return true;
        } catch (Exception $e) {
            dd($e->getMessage());
            Log::error('Product Entry Error' . $e->getMessage());
            return 0;
        }
    }

    /**
     * @param  Request  $request
     * @return array
     */
    public function getMyblProducts(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');

        $builder = new MyBlProduct();
        $builder = $builder->where('status', 1);
        /*        if ($request->status) {
          $builder = MyBlProduct::where('status', $request->status);
          } */
        if ($request->show_in_home != null) {
            $builder = $builder->where('show_in_home', $request->show_in_home);
        }

        $bundles = ['mix', 'voice', 'sms'];

        $builder = $builder->whereHas(
            'details',
            function ($q) use ($request, $bundles) {
                if ($request->product_code) {
                    $q->where('product_code', $request->product_code);
                }
                if ($request->sim_type) {
                    $q->where('sim_type', $request->sim_type);
                }

                if ($request->content_type) {
                    if (in_array($request->content_type, $bundles)) {
                        $q->where('content_type', $request->content_type);
                        $q->whereNull('call_rate');
                    } elseif ($request->content_type == 'recharge_offer') {
                        $q->whereNotNull('recharge_product_code');
                    } elseif ($request->content_type == 'scr') {
                        $q->whereNotNull('call_rate');
                    } else {
                        $q->where('content_type', $request->content_type);
                    }
                }
            }
        );

        if ($request->content_type == 'recharge_offer') {
            $builder->where('show_recharge_offer', 1);
        }


        $all_items_count = $builder->count();
        $items = $builder->skip($start)->take($length)->get();

        $response = [
            'draw' => $draw,
            'recordsTotal' => $all_items_count,
            'recordsFiltered' => $all_items_count,
            'data' => []
        ];

        $items->each(function ($item) use (&$response) {
            $response['data'][] = [
                'product_code' => $item->product_code,
                'renew_product_code' => $item->details->renew_product_code,
                'recharge_product_code' => $item->details->recharge_product_code,
                'connection_type' => $item->details->sim_type,
                'name' => $item->details->name,
                'description' => $item->details->short_description,
                'content_type' => ucfirst($item->details->content_type),
                'family_name' => ucfirst($item->details->family_name),
                'offer_section' => ucfirst($item->offer_section_title),
                'show_in_home' => ($item->show_in_home) ? 'Yes' : 'No',
                'media' => ($item->media) ? 'Yes' : 'No',
                'status' => $item->details->status
            ];
        });

        return $response;
    }

    /**
     * @param $contentType
     * @return int|null
     */
    protected function offerType($contentType)
    {
        switch (strtolower($contentType)) {
            case "internet":
                $offerId = 1;
                break;
            case "voice":
                $offerId = 2;
                break;
            case "bundle":
                $offerId = 3;
                break;
            case "startup":
                $offerId = 4;
                break;
            default:
                $offerId = null;
        }
        return $offerId;
    }

    /**
     * @param $excel_path
     * @return bool|int
     */
    public function mapAssetliteProduct($excel_path)
    {
        $config = config('productMapping.assetlite.columns');

        try {
            $reader = ReaderFactory::createFromType(Type::XLSX); // for XLSX files
            $file_path = $excel_path;
            $reader->open($file_path);

            foreach ($reader->getSheetIterator() as $sheet) {
                $row_number = 1;
                foreach ($sheet->getRowIterator() as $row) {
                    $core_data = [];
                    $assetLiteProduct = [];
                    if ($row_number != 1) {
                        $cells = $row->getCells();
                        foreach ($config as $field => $index) {
                            switch ($field) {
//                                case "family_name":
                                case "content_type":
                                    $contentType = ($cells [$index]->getValue() != '') ?
                                        strtolower($cells [$index]->getValue()) : null;
                                    $core_data [$field] = $contentType;
                                    break;

                                case "assetlite_offer_type":
                                    $contentType = ($cells [$index]->getValue() != '') ?
                                        strtolower($cells [$index]->getValue()) : null;
                                    $offerId = $this->offerType($contentType);
                                    $assetLiteProduct['offer_category_id'] = $offerId;
                                    if ($offerId == 4) {
                                        $assetLiteProduct['offer_info'] = ['package_offer_type_id' => 6];
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
                                        $sim_type = null;
                                    }
                                    $core_data [$field] = $sim_type;
                                    $assetLiteProduct ['sim_category_id'] = $sim_type;
                                    break;
                                case "commercial_name_en":
                                    $core_data [$field] = $cells [$index]->getValue();
                                    $assetLiteProduct['name_en'] = $cells [$index]->getValue();
                                    break;
                                case "commercial_name_bn":
                                    $core_data [$field] = $cells [$index]->getValue();
                                    $assetLiteProduct['name_bn'] = $cells [$index]->getValue();
                                    break;

                                case "is_auto_renewable":
//                                    $core_data [$field] = $cells [$index]->getValue();
                                    $assetLiteProduct['is_auto_renewable'] = $cells [$index]->getValue();
                                    break;
                                case "recharge_product_code":
                                    $type = $cells [$index]->getValue();
                                    $assetLiteProduct['purchase_option'] = ($type != "") ? 'recharge' : '';
                                    $core_data[$field] = $type;
                                    break;

                                case "short_text":
                                    if (!empty($cells[$index]->getValue())) {
                                        $assetLiteProduct['offer_info'] = [
                                            'short_text' => $cells[$index]->getValue()
                                        ];
                                    }
                                    break;

                                case "rate_cutter_offer":
                                    $type = $cells [$index]->getValue();
                                    $core_data['call_rate'] = ($type == "") ? null : $type;
                                    $assetLiteProduct['rate_cutter_offer'] = ($type == "") ? null : 1;
                                    break;
                                case "rate_cutter_unit":
                                    $type = $cells [$index]->getValue();
                                    $assetLiteProduct['rate_cutter_unit'] = ($type == "") ? null : $type;
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
                                case "vat":
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

                                case "validity":
                                    $validity = $cells [$index]->getValue();
                                    if (!is_string($validity)) {
                                        $core_data [$field] = $validity;
                                    }
                                    break;

                                case "validity_in_days":
                                    $validity = $cells [$config['validity']]->getValue();

                                    if ($validity == "Bill period") {
                                        $assetLiteProduct['validity_postpaid'] = $validity;
//                                        dd($assetLiteProduct);
                                    } else {
                                        $unit = $cells [$config['validity_unit']]->getValue();
                                        if (strtolower($unit) == 'hours') {
                                            $validity = round($validity / 24);
                                        }
                                        $core_data [$field] = ($validity == "") ? null : $validity;
                                    }
                                    break;

                                case "is_amar_offer":
                                    $type = strtolower($cells [$index]->getValue());
                                    if ($type == 'yes') {
                                        $flag = 1;
                                    } elseif ($type == 'no') {
                                        $flag = 0;
                                    } else {
                                        break;
                                    }
                                    $assetLiteProduct[$field] = $flag;
                                    break;
                                case "is_gift_offer":
                                    $giftOffer = strtolower($cells [$index]->getValue());
//                                    $core_data [$field] = $giftOffer;
                                    $assetLiteProduct[$field] = $giftOffer;
                                    break;
                                case "is_social_pack":
                                    $assetLiteProduct [$field] = ($cells [$index]->getValue() != '') ?
                                        $cells [$index]->getValue() : null;
                                    break;
                                default:
                                    $core_data [$field] = ($cells [$index]->getValue() != '') ?
                                        $cells [$index]->getValue() : null;
                            }
                        }

                        try {
                            $product_code = $core_data['product_code'];
                            $core_product = AlCoreProduct::where('product_code', $product_code)->first();

                            if ($core_product) {
                                if ($core_product->platform == 'app') {
                                    $core_data ['platform'] = 'all';
                                }
                            } else {
                                $core_data['platform'] = 'web';
                            }

//                            dd($core_data);

                            AlCoreProduct::updateOrCreate([
                                'product_code' => $product_code
                            ], $core_data);


                            if ($assetLiteProduct['offer_category_id']) {

                                //make url_slug
                                $assetLiteProduct['url_slug'] = "";
                                if(!empty($assetLiteProduct['name_en'])){
                                    $urlSlug = str_replace(" ", "-", $assetLiteProduct['name_en']);
                                    $assetLiteProduct['url_slug']  = $urlSlug;
                                }

                                $product = Product::updateOrCreate([
                                    'product_code' => $product_code
                                ], $assetLiteProduct);

                                $this->_saveSearchData($product);


                                ProductDetail::updateOrCreate([
                                    'product_id' => $product->id
                                ]);
                            }
                        } catch (Exception $e) {
                            dd($e->getMessage());
                            continue;
                        }
                    }
                    $row_number++;
                }
            }
            $reader->close();
            return true;
        } catch (Exception $e) {
            dd($e->getMessage());
            Log::error('Product Entry Error' . $e->getMessage());
            return 0;
        }
    }

    //save Search Data
    private function _saveSearchData($product) {
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

        $keywordType = "offer-".$product->offer_category->alias;


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



    /**
     *  Product search by Code
     *
     * @param $keyword
     * @return mixed
     */
    public function searchProductCodes($keyword)
    {
        return AlCoreProduct::where('product_code', 'like', '%' . $keyword . '%')->get();
    }

    /**
     * Get Product details
     *
     * @param $product_code
     * @return MyBlProduct|object|null
     */
    public function getProductDetails($product_code)
    {
        return MyBlProduct::with('details')->where('product_code', $product_code)->first();
    }

    /**
     * Update my-bl products
     *
     * @param  Request  $request
     * @param $product_code
     * @return RedirectResponse
     * @throws Exception
     */
    public function updateMyblProducts(Request $request, $product_code)
    {
        if ($request->file('media')) {
            $file = $request->media;
            $path = $file->storeAs(
                'products/images',
                $product_code . '_' . strtotime(now()) . '.' . $file->getClientOriginalExtension(),
                'public'
            );

            $data['media'] = $path;
        }/* else {
            $data['media'] = null;
        }*/

        if ($request->has('offer_section_slug')) {
            $data['offer_section_slug'] = $request->offer_section_slug;
            $offer = MyBlInternetOffersCategory::where('slug', $request->offer_section_slug)->first();
            $data['offer_section_title'] = $offer->name;
        }
        $data['tag'] = $request->tag;
        $data['show_in_home'] = isset($request->show_in_app) ? true : false;
        $data['is_rate_cutter_offer'] = isset($request->is_rate_cutter_offer) ? true : false;

        try {
            DB::beginTransaction();

            $model = MyBlProduct::where('product_code', $product_code);
            $model->update($data);

            $core_product = AlCoreProduct::where('product_code', $product_code)->get()->toArray();

            $data_request = $request->all();
            unset($data_request['_token']);
            unset($data_request['_method']);
            unset($data_request['tag']);
            unset($data_request['media']);
            unset($data_request['show_in_app']);
            unset($data_request['is_rate_cutter_offer']);
            unset($data_request['offer_section_slug']);
            unset($data_request['offer_section_title']);

            if (isset($data_request['data_volume'])) {
                $data_request['data_volume'] = substr(
                    $data_request['data_volume'],
                    0,
                    strrpos($data_request['data_volume'], ' ')
                );
            }

            if (isset($data_request['sms_volume'])) {
                $data_request['sms_volume'] = substr(
                    $data_request['sms_volume'],
                    0,
                    strrpos($data_request['sms_volume'], ' ')
                );
            }

            if (isset($data_request['minute_volume'])) {
                $data_request['minute_volume'] = substr(
                    $data_request['minute_volume'],
                    0,
                    strrpos($data_request['minute_volume'], ' ')
                );
            }

            if (isset($data_request['validity'])) {
                $data_request['validity'] = substr(
                    $data_request['validity'],
                    0,
                    strrpos($data_request['validity'], ' ')
                );
            }

            $data_history = $core_product[0];

            $data_history['created_by'] = Auth::user()->id;

            $data_history['product_core_id'] = $core_product[0]['id'];

            ProductCoreHistory::create($data_history);

            $model = AlCoreProduct::where('product_code', $product_code);
            $model->update($data_request);

            $this->resetProductRedisKeys();

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            throw new Exception($e->getMessage());
        }

        return Redirect::back()->with('success', 'Product updated Successfully');
    }

    public function downloadMyblProducts()
    {
        $products = MyBlProduct::whereHas('details')->with('details')->where('status', 1)->get();

        $products = $products->sortBy('details.content_type');

        $writer = WriterEntityFactory::createXLSXWriter();

        $writer->openToBrowser('mybl-products-' . date('Y-m-d') . '.xlsx');

        // header Style
        $header_style = (new StyleBuilder())
            ->setFontBold()
            ->setFontSize(11)
            ->setBackgroundColor(Color::rgb(245, 245, 240))
            ->build();

        $data_style = (new StyleBuilder())
            ->setFontSize(9)
            ->build();


        $header = config('productMapping.mybl.columns');

        unset($header['internet_volume_mb']);

        $header['Active'] = $header['status'];
        unset($header['status']);

        $headers = array_map(function ($val) {
            return str_replace('_', ' ', ucwords($val));
        }, array_keys($header));

        array_pop($headers);


        $row = WriterEntityFactory::createRowFromArray(array_values($headers), $header_style);
        $writer->addRow($row);

        $problem = [];

        foreach ($products as $product) {
            if ($product->details) {
                $insert_data[0] = ($product->sim_type == 2) ? 'Postpaid' : 'Prepaid';
                $insert_data[1] = $product->details->content_type;
                $insert_data[2] = $product->details->product_code;
                $insert_data[3] = $product->details->renew_product_code;
                $insert_data[4] = $product->details->recharge_product_code;
                $insert_data[5] = $product->details->name;
                $insert_data[6] = $product->details->commercial_name_en;
                $insert_data[7] = $product->details->commercial_name_bn;
                $insert_data[8] = $product->details->short_description;
                $insert_data[9] = $product->details->activation_ussd;
                $insert_data[10] = $product->details->balance_check_ussd;
                $insert_data[11] = $product->details->sms_volume;
                $insert_data[12] = $product->details->minute_volume;
                $insert_data[13] = $product->details->data_volume;
                $insert_data[14] = $product->details->data_volume_unit;
                $insert_data[15] = $product->details->validity;
                $insert_data[16] = $product->details->validity_unit;
                $insert_data[17] = $product->details->mrp_price;
                $insert_data[18] = $product->details->price;
                $insert_data[19] = $product->details->vat;
                $insert_data[20] = ($product->show_recharge_offer) ? 'Yes' : 'No';
                $insert_data[21] = ($product->is_rate_cutter_offer) ? 'Yes' : 'No';
                $insert_data[22] = $product->offer_section_title;
                $insert_data[23] = $product->tag;
                $insert_data[24] = $product->details->call_rate;
                $insert_data[25] = $product->details->call_rate_unit;
                $insert_data[26] = ($product->status) ? 'Yes' : 'No';

                $row = WriterEntityFactory::createRowFromArray($insert_data, $data_style);

                $writer->addRow($row);
            } else {
                $problem [] = $product->product_code;
            }
        }

        Log::info(json_encode($problem));
        $writer->close();
    }

    public function resetProductRedisKeys()
    {
        $pattern = Str::slug(env('REDIS_PREFIX', 'laravel'), '_') . '_database_';
        $keys = Redis::keys('available_products:*');
        $values = [];

        foreach ($keys as $key) {
            $values [] = str_replace($pattern, '', $key);
        }
        //Log::info(json_encode($values));
        if (!empty($values)) {
            Redis::del($values);
        }
    }

    public function syncProductCategory($path){

        try {
            $productCodes = [];
            $slugs       = [];
            $reader = ReaderFactory::createFromType(Type::XLSX); // for XLSX files
            $file_path = $path;
            $reader->open($file_path);

            foreach ($reader->getSheetIterator() as $sheet) {
                $row_number = 1;
                foreach ($sheet->getRowIterator() as $row) {
                    if($row_number==1){
                        $cells          = $row->getCells();
                        $cell1Title     = strtolower($cells[0]->getValue());
                        $cell2Title     = strtolower($cells[1]->getValue());
                        if($cell1Title != "code" || $cell2Title != "slugs"){
                            return response()->json([
                                'failed' => 'FAILED',
                                'message' => 'Failed to upload excel'
                            ], 500);
                        }
                        
                        ++$row_number;
                        continue;
                    }
                    $cells          = $row->getCells();
                    $productCode    = $cells[0]->getValue();
                    $slugs          = (explode(",",$cells[1]->getValue()));
                    
                    if(!isset($productCodes[$productCode])){
                        $findProduct = $this->alCoreProductRepository->findWithProduct($productCode);
                        if($findProduct == null)continue;
                        $productCodes[$productCode] = true;
                    }
                    // dd($productCode, $slugs[$slug]);
                    $categoriesIds = $this->alInternetOffersCategoryService->findCategoryIdByslugs($slugs);
                    if(isset($categoriesIds[0]))$this->alInternetOffersCategoryService->upSert($productCode, $categoriesIds);
                }
            }
            $reader->close();
            return response()->json([
                'success' => 'SUCCESS'
            ], 200);
        } catch (Exception $e) {
            Log::error('Excel Entry Error: ' . $e->getMessage());
            return response()->json([
                'failed' => 'FAILED',
                'message' => 'Failed to upload excel'
            ], 500);
        }
    }
}

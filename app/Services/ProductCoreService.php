<?php

namespace App\Services;

use App\Models\AlCoreProduct;
use App\Models\MyBlInternetOffersCategory;
use App\Models\MyBlProduct;
use App\Models\MyBlProductTab;
use App\Models\Product;
use App\Models\ProductCore;
use App\Models\ProductCoreHistory;
use App\Models\ProductDetail;
use App\Models\ProductTag;
use App\Repositories\MyblCashBackProductRepository;
use App\Repositories\MyBlProductRepository;
use App\Repositories\MyBlProductSchedulerRepository;
use App\Repositories\MyBlProductTagRepository;
use App\Repositories\ProductActivityRepository;
use App\Repositories\ProductCoreRepository;
use App\Repositories\ProductDeepLinkRepository;
use App\Repositories\SearchDataRepository;
use App\Repositories\TagCategoryRepository;
use App\Traits\CrudTrait;
use Box\Spout\Common\Entity\Style\Color;
use Box\Spout\Common\Type;
use Box\Spout\Reader\Common\Creator\ReaderFactory;
use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Writer\Common\Creator\WriterFactory;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;
use App\Models\ProductDeepLink;

/**
 * Class ProductCoreService
 * @package App\Services
 */
class ProductCoreService
{
    use CrudTrait;

    /**
     * @var $partnerOfferRepository
     */
    protected $productCoreRepository;
    protected $searchRepository;
    protected $tagRepository;
    protected $productDeepLinkRepository;

    protected const CREATE = "create";
    protected const UPDATE = "update";
    protected const DELETE = "delete";
    protected const PLATFORM = "app";
    /**
     * @var array
     */
    protected $config;
    /**
     * @var MyBlProductTagRepository
     */
    private $myBlProductTagRepository;
    /**
     * @var MyBlProductRepository
     */
    private $myBlProductRepository;
    /**
     * @var ProductActivityRepository
     */
    private $productActivityRepository;
    private $myblProductScheduleRepository;
    /**
     * ProductCoreService constructor.
     * @param ProductCoreRepository $productCoreRepository
     * @param MyBlProductRepository $myBlProductRepository
     * @param ProductActivityRepository $productActivityRepository
     * @param SearchDataRepository $searchRepository
     * @param TagCategoryRepository $tagRepository
     * @param ProductDeepLinkRepository $productDeepLinkRepository
     * @param MyBlProductTagRepository $myBlProductTagRepository
     */
    public function __construct(
        ProductCoreRepository $productCoreRepository,
        MyBlProductRepository $myBlProductRepository,
        ProductActivityRepository $productActivityRepository,
        SearchDataRepository $searchRepository,
        TagCategoryRepository $tagRepository,
        ProductDeepLinkRepository $productDeepLinkRepository,
        MyBlProductTagRepository $myBlProductTagRepository,
        MyBlProductSchedulerRepository $myblProductScheduleRepository
    ) {
        $this->productCoreRepository = $productCoreRepository;
        $this->myBlProductRepository = $myBlProductRepository;
        $this->productActivityRepository = $productActivityRepository;
        $this->searchRepository = $searchRepository;
        $this->tagRepository = $tagRepository;
        $this->productDeepLinkRepository = $productDeepLinkRepository;
        $this->setActionRepository($productCoreRepository);
        $this->myBlProductTagRepository = $myBlProductTagRepository;
        $this->myblProductScheduleRepository = $myblProductScheduleRepository;
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

//    /**
//     * @param $id
//     * @return string|null
//     */
//    public function getSimtype($id)
//    {
//        switch ($id) {
//            case "1":
//                $type = "prepaid";
//                break;
//            case '2':
//                $type = "postpaid";
//                break;
//            case '3':
//                $type = "propaid";
//                break;
//            default:
//                $type = null;
//        }
//        return $type;
//    }

    /**
     * @param $data
     * @param $simId
     * @return void
     */
    public function storeProductCore($data, $simId)
    {
        $productCode = $this->productCoreRepository
            ->findByProperties(['product_code' => $data['product_code']])
            ->first();
        if (empty($productCode)) {
            $data['name'] = $data['name_en'];
            $data['product_code'] = str_replace(' ', '', strtoupper($data['product_code']));
            $data['recharge_product_code'] = isset($data['recharge_product_code']) ? str_replace(' ', '',
                strtoupper($data['recharge_product_code'])) : null;
            $data['renew_product_code'] = isset($data['renew_product_code']) ? str_replace(' ', '',
                strtoupper($data['renew_product_code'])) : null;
            $data['commercial_name_en'] = $data['name_en'];
            $data['commercial_name_bn'] = $data['name_bn'];
            $data['content_type'] = $this->getType($data['offer_category_id']);
            $data['sim_type'] = $simId;
            $this->save($data);
            return true;
        }
        return false;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findProductCore($id)
    {
        return $this->productCoreRepository->findWithProduct($id);
    }

    /**
     * @param $data
     * @param $id
     */
    public function updateProductCore($data, $id)
    {
        $product = $this->productCoreRepository->findOneProductCore($id);
        if (!$product) {
            $data['name'] = $data['name_en'];
            $data['product_code'] = strtoupper($id);
            $data['recharge_product_code'] = isset($data['recharge_product_code']) ? str_replace(' ', '',
                strtoupper($data['recharge_product_code'])) : null;
            $data['renew_product_code'] = isset($data['renew_product_code']) ? str_replace(' ', '',
                strtoupper($data['renew_product_code'])) : null;
            $data['commercial_name_en'] = $data['name_en'];
            $data['commercial_name_bn'] = $data['name_bn'];
            $data['content_type'] = $this->getType($data['offer_category_id']);
            $data['sim_type'] = (strtolower($data['type']) == 'prepaid') ? 1 : 2;
            $this->save($data);
        } else {
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
                    $productTabs = [];
                    $tags = [];

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
                                    elseif (strtolower($data_volume) == 'unlimited' || $data_volume == -1) {
                                        $data_volume = -1;
                                    }
                                    $core_data [$field] = $data_volume;
                                    break;
                                case "sms_volume":
                                case "minute_volume":
                                    $volume = $cells [$index]->getValue();
                                    if ($volume == '') {
                                        $volume = 0;
                                    }
                                    elseif (strtolower($volume) == 'unlimited' || $volume == -1) {
                                        $volume = -1;
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
                                        $titleArr = explode(',', $title);
                                        $mybl_data[$field] = $titleArr[0];
                                        $mybl_data['offer_section_slug'] = str_replace(' ', '_',
                                            strtolower($titleArr[0]));

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
                                    $rawTags = explode(',', $cells [$index]->getValue());
                                    $tags = collect($rawTags)->map(function ($item) {
                                        return trim($item);
                                    })->toArray();
                                    $mybl_data[$field] = $tags[0] ?? "";
                                    break;

                                case "show_from":
                                case "hide_from":
                                    if (!empty($cells[$index]->getValue())) {
                                        $time = Carbon::createFromFormat(
                                            'd-m-Y h:i A',
                                            $cells[$index]->getValue()
                                        )->format('Y-m-d H:i:s');
                                    } else {
                                        $time = null;
                                    }
                                    $mybl_data[$field] = $time;
                                    break;
                                default:
                                    $core_data [$field] = ($cells [$index]->getValue() != '') ?
                                        $cells [$index]->getValue() : null;
                            }
                        }

                        try {
                            $product_code = $core_data['product_code'];

                            $core_product = ProductCore::where('product_code', $product_code)->first();

                            if ($core_product) {
                                if ($core_product->platform == 'web') {
                                    $core_data ['platform'] = 'all';
                                }
                            } else {
                                $core_data['platform'] = 'app';
                            }

                            ProductCore::updateOrCreate([
                                'product_code' => $product_code
                            ], $core_data);

                            MyBlProduct::updateOrCreate([
                                'product_code' => $product_code
                            ], $mybl_data);

                            if (count($productTabs)) {
                                MyBlProductTab::where('product_code', $product_code)->delete();

                                foreach ($productTabs as $productTab) {
                                    $productTabInsert = new MyBlProductTab();
                                    $productTabInsert->product_code = $productTab['product_code'];
                                    $productTabInsert->my_bl_internet_offers_category_id = $productTab['my_bl_internet_offers_category_id'];
                                    $productTabInsert->save();
                                }
                            }

                            if (count($tags)) {
                                $existingTags = ProductTag::whereIn('title', $tags)->get();
                                $existingTagTitles = $existingTags->pluck('title')->toArray();
                                $existingTagIds = $existingTags->pluck('id')->toArray();

                                foreach ($tags as $tag) {
                                    if (!in_array($tag, Arr::flatten($existingTagTitles)) && $tag != "") {
                                        $tagInsert = new ProductTag();
                                        $tagInsert->title = $tag;
                                        $tagInsert->priority = rand(5, 10);
                                        $tagInsert->save();
                                    }
                                }

                                #For update the color in my_bl_products table. Only for existing tag
                                foreach ($existingTags as $key => $value) {
                                    if($value->title == $tags[0]){
                                        $myBlProduct = MyBlProduct::where('product_code', $product_code)->update(['tag_bgd_color' => $value->tag_bgd_color, 'tag_text_color' => $value->tag_text_color]);
                                    }
                                }                              

                                #Take the first Element from the tags array
                                $this->syncProductTags($product_code, Arr::flatten($existingTagIds));
                            }

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

    /**
     * @param Request $request
     * @return array
     */
    public function getMyblProducts(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');

        $builder = new MyBlProduct();
        $builder = $builder->where('status', 1);
        $builder = $builder->latest();
        /*        if ($request->status) {
          $builder = MyBlProduct::where('status', $request->status);
          } */
        if ($request->show_in_home != null) {
            $builder = $builder->where('show_in_home', $request->show_in_home);
        }

        if ($request->pinned_products != "") {
            $builder = $builder->where('pin_to_top', $request->pinned_products);
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
                    } elseif ($request->content_type == 'free_products') {
                        $q->where('mrp_price', null);
                    } elseif ($request->content_type == 'is_popular_pack') {
                        $q->where('is_popular_pack', 1);
                    } else {
                        $q->where('content_type', $request->content_type);
                    }
                }
            }
        )->with('details');

        if ($request->content_type == 'is_popular_pack') {
            $builder =  $builder->where('is_popular_pack', 1);
        }

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
            $activeSchedule = $item->scheduleStatus() ? config('productMapping.mybl.product_schedule_statuses.'
                . $item->scheduleStatus()) : 'Shown';
            $link = $this->productDeepLinkRepository->findOneProductLink($item->product_code);
            $response['data'][] = [
                'product_code' => $item->product_code,
                'pin_to_top' => $item->pin_to_top,
                'renew_product_code' => optional($item->details)->renew_product_code ?? "",
                'recharge_product_code' => optional($item->details)->recharge_product_code ?? "",
                'connection_type' => optional($item->details)->sim_type ?? "",
                'name' => optional($item->details)->name ?? "",
                'description' => optional($item->details)->short_description ?? "",
                'content_type' => ucfirst(optional($item->details)->content_type ?? ""),
                'family_name' => ucfirst(optional($item->details)->family_name ?? ""),
                'offer_section' => ucfirst($item->offer_section_title),
                'show_in_home' => ($item->show_in_home) ? 'Yes' : 'No',
                'media' => ($item->media) ? 'Yes' : 'No',
                'status' => optional($item->details)->status ?? "",
                'is_visible' => $item->is_visible ? $activeSchedule : 'Hidden',
                'show_from' => $item->show_from ? Carbon::parse($item->show_from)->format('d-m-Y h:i A') : '',
                'hide_from' => $item->hide_from ? Carbon::parse($item->hide_from)->format('d-m-Y h:i A') : '',
                'deep_link' => !empty($link->deep_link) ? $link->deep_link : null,

            ];
        });
        return $response;
    }

//    /**
//     * @param $contentType
//     * @return int|null
//     */
//    protected function offerType($contentType)
//    {
//        switch (strtolower($contentType)) {
//            case "internet":
//                $offerId = 1;
//                break;
//            case "voice":
//                $offerId = 2;
//                break;
//            case "bundle":
//                $offerId = 3;
//                break;
//            case "startup":
//                $offerId = 4;
//                break;
//            default:
//                $offerId = null;
//        }
//        return $offerId;
//    }
//
//    /**
//     * @param $excel_path
//     * @return bool|int
//     */
//    public function mapAssetliteProduct($excel_path)
//    {
//        $config = config('productMapping.assetlite.columns');
//
//        try {
//            $reader = ReaderFactory::createFromType(Type::XLSX); // for XLSX files
//            $file_path = $excel_path;
//            $reader->open($file_path);
//
//            foreach ($reader->getSheetIterator() as $sheet) {
//                $row_number = 1;
//                foreach ($sheet->getRowIterator() as $row) {
//                    $core_data = [];
//                    $assetLiteProduct = [];
//                    if ($row_number != 1) {
//                        $cells = $row->getCells();
//                        foreach ($config as $field => $index) {
//                            switch ($field) {
////                                case "family_name":
//                                case "content_type":
//                                    $contentType = ($cells [$index]->getValue() != '') ?
//                                        strtolower($cells [$index]->getValue()) : null;
//                                    $core_data [$field] = $contentType;
//                                    break;
//
//                                case "assetlite_offer_type":
//                                    $contentType = ($cells [$index]->getValue() != '') ?
//                                        strtolower($cells [$index]->getValue()) : null;
//                                    $offerId = $this->offerType($contentType);
//                                    $assetLiteProduct['offer_category_id'] = $offerId;
//                                    if ($offerId == 4) {
//                                        $assetLiteProduct['offer_info'] = ['package_offer_type_id' => 6];
//                                    }
//                                    break;
//                                case "sim_type":
//                                    $type = strtolower($cells [$index]->getValue());
//                                    if ($type == 'prepaid') {
//                                        $sim_type = 1;
//                                    } elseif ($type == 'postpaid') {
//                                        $sim_type = 2;
//                                    } elseif ($type == 'propaid') {
//                                        $sim_type = 3;
//                                    } else {
//                                        $sim_type = null;
//                                    }
//                                    $core_data [$field] = $sim_type;
//                                    $assetLiteProduct ['sim_category_id'] = $sim_type;
//                                    break;
//                                case "commercial_name_en":
//                                    $core_data [$field] = $cells [$index]->getValue();
//                                    $assetLiteProduct['name_en'] = $cells [$index]->getValue();
//                                    break;
//                                case "commercial_name_bn":
//                                    $core_data [$field] = $cells [$index]->getValue();
//                                    $assetLiteProduct['name_bn'] = $cells [$index]->getValue();
//                                    break;
//
//                                case "is_auto_renewable":
////                                    $core_data [$field] = $cells [$index]->getValue();
//                                    $assetLiteProduct['is_auto_renewable'] = $cells [$index]->getValue();
//                                    break;
//                                case "recharge_product_code":
//                                    $type = $cells [$index]->getValue();
//                                    $assetLiteProduct['purchase_option'] = ($type != "") ? 'recharge' : '';
//                                    $core_data[$field] = $type;
//                                    break;
//
//                                case "short_text":
//                                    if (!empty($cells[$index]->getValue())) {
//                                        $assetLiteProduct['offer_info'] = [
//                                            'short_text' => $cells[$index]->getValue()
//                                        ];
//                                    }
//                                    break;
//
//                                case "rate_cutter_offer":
//                                    $type = $cells [$index]->getValue();
//                                    $core_data['call_rate'] = ($type == "") ? null : $type;
//                                    $assetLiteProduct['rate_cutter_offer'] = ($type == "") ? null : 1;
//                                    break;
//                                case "rate_cutter_unit":
//                                    $type = $cells [$index]->getValue();
//                                    $assetLiteProduct['rate_cutter_unit'] = ($type == "") ? null : $type;
//                                    break;
//
//                                case "internet_volume_mb":
//                                    $data_volume = $cells [$index]->getValue();
//                                    if ($data_volume == '') {
//                                        $data_volume = 0;
//                                    }
//                                    $data_unit = $cells [$index + 1]->getValue();
//                                    if ($data_unit == 'GB') {
//                                        $volume = $data_volume * 1024;
//                                        $core_data [$field] = $volume;
//                                    } else {
//                                        $core_data [$field] = $data_volume;
//                                    }
//                                    break;
//                                case "data_volume":
//                                    $data_volume = $cells [$index]->getValue();
//
//                                    if ($data_volume == '') {
//                                        $data_volume = 0;
//                                    }
//                                    $core_data [$field] = $data_volume;
//                                    break;
//                                case "vat":
//                                case "sms_volume":
//                                case "minute_volume":
//                                    $volume = $cells [$index]->getValue();
//                                    if ($volume == '') {
//                                        $volume = 0;
//                                    }
//                                    $core_data [$field] = $volume;
//                                    break;
//                                case "internet_volume_unit":
//                                    $data_volume_unit = $cells [$index]->getValue();
//                                    $core_data [$field] = $data_volume_unit;
//                                    break;
//
//                                case "validity":
//                                    $validity = $cells [$index]->getValue();
//                                    if (!is_string($validity)) {
//                                        $core_data [$field] = $validity;
//                                    }
//                                    break;
//
//                                case "validity_in_days":
//                                    $validity = $cells [$config['validity']]->getValue();
//
//                                    if ($validity == "Bill period") {
//                                        $assetLiteProduct['validity_postpaid'] = $validity;
////                                        dd($assetLiteProduct);
//                                    } else {
//                                        $unit = $cells [$config['validity_unit']]->getValue();
//                                        if (strtolower($unit) == 'hours') {
//                                            $validity = round($validity / 24);
//                                        }
//                                        $core_data [$field] = ($validity == "") ? null : $validity;
//                                    }
//                                    break;
//
//                                case "is_amar_offer":
//                                    $type = strtolower($cells [$index]->getValue());
//                                    if ($type == 'yes') {
//                                        $flag = 1;
//                                    } elseif ($type == 'no') {
//                                        $flag = 0;
//                                    } else {
//                                        break;
//                                    }
//                                    $assetLiteProduct[$field] = $flag;
//                                    break;
//                                case "is_gift_offer":
//                                    $giftOffer = strtolower($cells [$index]->getValue());
////                                    $core_data [$field] = $giftOffer;
//                                    $assetLiteProduct[$field] = $giftOffer;
//                                    break;
//                                case "is_social_pack":
//                                    $assetLiteProduct [$field] = ($cells [$index]->getValue() != '') ?
//                                        $cells [$index]->getValue() : null;
//                                    break;
//                                default:
//                                    $core_data [$field] = ($cells [$index]->getValue() != '') ?
//                                        $cells [$index]->getValue() : null;
//                            }
//                        }
//
//                        try {
//                            $product_code = $core_data['product_code'];
//                            $core_product = ProductCore::where('product_code', $product_code)->first();
//
//                            if ($core_product) {
//                                if ($core_product->platform == 'app') {
//                                    $core_data ['platform'] = 'all';
//                                }
//                            } else {
//                                $core_data['platform'] = 'web';
//                            }
//
////                            dd($core_data);
//
//                            AlCoreProduct::updateOrCreate([
//                                'product_code' => $product_code
//                            ], $core_data);
//
//
//                            if ($assetLiteProduct['offer_category_id']) {
//                                //make url_slug
//                                $assetLiteProduct['url_slug'] = "";
//                                if (!empty($assetLiteProduct['name_en'])) {
//                                    $urlSlug = str_replace(" ", "-", $assetLiteProduct['name_en']);
//                                    $assetLiteProduct['url_slug'] = $urlSlug;
//                                }
//
//                                $product = Product::updateOrCreate([
//                                    'product_code' => $product_code
//                                ], $assetLiteProduct);
//
//                                $this->_saveSearchData($product);
//
//
//                                ProductDetail::updateOrCreate([
//                                    'product_id' => $product->id
//                                ]);
//                            }
//                        } catch (Exception $e) {
//                            dd($e->getMessage());
//                            continue;
//                        }
//                    }
//                    $row_number++;
//                }
//            }
//            $reader->close();
//            return true;
//        } catch (Exception $e) {
//            dd($e->getMessage());
//            Log::error('Product Entry Error' . $e->getMessage());
//            return 0;
//        }
//    }

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


    /**
     *  Product search by Code
     *
     * @param $keyword
     * @return mixed
     */
    public function searchProductCodes($keyword)
    {
        return ProductCore::where('product_code', 'like', '%' . $keyword . '%')->get();
    }

    /**
     * Get Product details
     *
     * @param $product_code
     * @return MyBlProduct|object|null
     */
    public function getProductDetails($product_code)
    {
        return MyBlProduct::with('details', 'tabs')->where('product_code', $product_code)->first();
    }

    public function getInactiveProducts()
    {
        $myBlInactiveProducts = MyBlProduct::where('status', 0)->get()->pluck('product_code')->toArray();
        return ProductCore::whereIn('product_code', $myBlInactiveProducts)->get();
    }

    public function activateProduct($productCode)
    {
        try {
            MyBlProduct::where('product_code', $productCode)->update(['status' => 1]);
            ProductCore::where('product_code', $productCode)->update(['status' => 1]);
            return true;
        } catch (Exception $exception) {
            Log::error('Error while activating product having code: ' . $productCode . '. Message: ' . $exception->getMessage());
            return false;
        }
    }

    /**
     * Update my-bl products
     *
     * @param Request $request
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

        $firstTag = ProductTag::where('id', $request->tags[0] ?? null)->first();
        $data['tag'] = isset($firstTag) ? $firstTag->title : null;
        $data['tag_bgd_color'] = isset($firstTag) ? $firstTag->tag_bgd_color : null;
        $data['tag_text_color'] = isset($firstTag) ? $firstTag->tag_text_color : null;
        $data['show_in_home'] = isset($request->show_in_app) ? true : false;
        $data['is_rate_cutter_offer'] = isset($request->is_rate_cutter_offer) ? true : false;
        $data['is_favorite'] = isset($request->is_favorite) ? true : false;
        $data['show_from'] = $request->show_from ? Carbon::parse($request->show_from)->format('Y-m-d H:i:s') : null;
        $data['hide_from'] = $request->hide_from ? Carbon::parse($request->hide_from)->format('Y-m-d H:i:s') : null;
        $data['is_visible'] = $request->is_visible;
        $data['status'] = $request->status ?? 0;
        $data['is_popular_pack'] = $request->is_popular_pack ?? 0;
        $data['pin_to_top'] = isset($request->pin_to_top) ? true : false;
        $data['is_banner_schedule'] = isset($request->is_banner_schedule) ? true : false;
        $data['is_tags_schedule'] = isset($request->is_tags_schedule) ? true : false;
        $data['is_visible_schedule'] = isset($request->is_visible_schedule) ? true : false;
        $data['is_pin_to_top_schedule'] = isset($request->is_pin_to_top_schedule) ? true : false;
        $data['is_base_msisdn_group_id_schedule'] = isset($request->is_base_msisdn_group_id_schedule) ? true : false;
        $coreData['is_commercial_name_en_schedule'] = isset($request->is_commercial_name_en_schedule) ? true : false;
        $coreData['is_commercial_name_bn_schedule'] = isset($request->is_commercial_name_bn_schedule) ? true : false;
        $coreData['is_display_title_en_schedule'] = isset($request->is_display_title_en_schedule) ? true : false;
        $coreData['is_display_title_bn_schedule'] = isset($request->is_display_title_bn_schedule) ? true : false;
        $data['base_msisdn_group_id'] = $request->base_msisdn_group_id;
        $data['special_type'] = isset($request->special_type) ? $request->special_type : null;
        $productSchedule = [];
        $isProductSchedule = false;

        if($data['is_banner_schedule'] == true) {
            if ($request->file('schedule_media')) {
                $file = $request->schedule_media;
                $path = $file->storeAs(
                    'products/images',
                    $request->product_code . '_' . strtotime(now()) . '.' . $file->getClientOriginalExtension(),
                    'public'
                );
                $productSchedule['media'] = $path;
            }
            $isProductSchedule = true;
        } else {
            $productSchedule['media'] = null;
            unset($data['is_banner_schedule']);
        }

        if ($data['is_tags_schedule'] == true) {
            if ($request->schedule_tags !=null) {
                $productSchedule['tags'] = json_encode($request->schedule_tags);
            }
            $isProductSchedule = true;
        } else {
            unset($data['is_tags_schedule']);
        }

        if ($data['is_visible_schedule'] == true) {
            $productSchedule['is_visible'] = $request->schedule_visibility;
            $isProductSchedule = true;
        } else {
            $productSchedule['is_visible'] = 0;
            unset($data['is_visible_schedule']);
        }

        if ($data['is_pin_to_top_schedule'] == true) {
            $productSchedule['pin_to_top'] = $request->schedule_pin_to_top;
            $isProductSchedule = true;
        } else {
            $productSchedule['pin_to_top'] = 0;
            unset($data['is_pin_to_top_schedule']);
        }

        if ($data['is_base_msisdn_group_id_schedule'] == true) {
            $productSchedule['base_msisdn_group_id'] = $request->schedule_base_msisdn_groups_id;
            $isProductSchedule = true;
        } else {
            $productSchedule['base_msisdn_group_id'] = null;
            unset($data['is_base_msisdn_group_id_schedule']);
        }

        if ($coreData['is_commercial_name_en_schedule']) {
            $productSchedule['commercial_name_en'] = $request->schedule_commercial_name_en;
            $isProductSchedule = true;
        } else {
            $productSchedule['commercial_name_en'] = null;
            unset($coreData['is_commercial_name_en_schedule']);
        }

        if ($coreData['is_commercial_name_bn_schedule']) {
            $productSchedule['commercial_name_bn'] = $request->schedule_commercial_name_bn;
            $isProductSchedule = true;
        } else {
            $productSchedule['commercial_name_bn'] = null;
            unset($coreData['is_commercial_name_bn_schedule']);
        }

        if ($coreData['is_display_title_en_schedule']) {
            $productSchedule['display_title_en'] = $request->schedule_display_title_en;
            $isProductSchedule = true;
        } else {
            $productSchedule['display_title_en'] = null;
            unset($coreData['is_display_title_en_schedule']);
        }

        if ($coreData['is_display_title_bn_schedule']) {
            $productSchedule['display_title_bn'] = $request->schedule_display_title_bn;
            $isProductSchedule = true;
        } else {
            $productSchedule['display_title_bn'] = null;
            unset($coreData['is_display_title_bn_schedule']);
        }


        if($isProductSchedule == true) {
            $productSchedule['start_date'] = Carbon::parse($request->start_date)->format('Y-m-d H:i:s');
            $productSchedule['end_date'] = Carbon::parse($request->end_date)->format('Y-m-d H:i:s');
        } else {
            $productSchedule['start_date'] = null;
            $productSchedule['end_date'] = null;
        }

        try {
            DB::beginTransaction();

            $model = MyBlProduct::where('product_code', $product_code);
            $data['pin_to_top_sequence'] = 100000;
            if ($data['pin_to_top']) {
                $data['pin_to_top_sequence'] = count(MyBlProduct::where('pin_to_top', true)->get()) + 1;
            }
            $model->update($data);

            $coreProduct = ProductCore::where('product_code', $product_code)->update($coreData);

            $productSchedule['product_code'] = $request->product_code;

            if ($isProductSchedule == true) {
                $this->myblProductScheduleRepository->createProductSchedule($productSchedule);
            }

            if ($request->has('tags')) {
                $this->syncProductTags($product_code, $request->tags);
            } else {
                $this->myBlProductTagRepository->deleteByProductCode($product_code);
            }

            if ($request->has('offer_section_slug')) {
                MyBlProductTab::where('product_code', $product_code)->delete();
                foreach ($request->offer_section_slug ?? [] as $offerSectionId) {
                    $model_tab = MyBlProductTab::where('product_code', $product_code);

                    $data_section_slug['product_code'] = $product_code;
                    $data_section_slug['my_bl_internet_offers_category_id'] = $offerSectionId;

                    $model_tab->updateOrCreate($data_section_slug);
                }
            }

            $core_product = ProductCore::where('product_code', $product_code)->get()->toArray();

            $data_request = $request->all();
            unset($data_request['_token']);
            unset($data_request['_method']);
            unset($data_request['tags']);
            unset($data_request['media']);
            unset($data_request['show_in_app']);
            unset($data_request['is_rate_cutter_offer']);
            unset($data_request['offer_section_slug']);
            unset($data_request['offer_section_title']);
            unset($data_request['show_from']);
            unset($data_request['hide_from']);
            unset($data_request['is_visible']);
            unset($data_request['pin_to_top']);

//            if (isset($data_request['internet_volume_mb'])) {
//                $data_request['data_volume'] = $data_request['internet_volume_mb'] / 1024;
//                $data_request['data_volume_unit'] = ($data_request['internet_volume_mb'] > 1024) ? 'GB' : 'MB';
//            }

            if (isset($request->internet_volume_mb)) {
                $data_request['data_volume_unit'] = $request['data_volume_unit'];
                $data_request['internet_volume_mb'] = ($request['data_volume_unit'] == "GB") ? $request['internet_volume_mb'] * 1024 : $request['internet_volume_mb'];
                $data_request['data_volume'] = $request['internet_volume_mb'];
            }

            if (isset($data_request['sms_volume'])) {
                $data_request['sms_volume'] = substr(
                    $data_request['sms_volume'],
                    0,
                    strrpos($data_request['sms_volume'], ' ')
                );
            }

            $data_request['product_code'] = strtoupper(str_replace(' ', '', $request->product_code));
            $data_request['renew_product_code'] = strtoupper(str_replace(' ', '', $request->renew_product_code));
            $data_request['recharge_product_code'] = strtoupper(str_replace(' ', '', $request->recharge_product_code));

            $data_history = $core_product[0];

            $data_history['created_by'] = Auth::user()->id;

            $data_history['product_core_id'] = $core_product[0]['id'];

            ProductCoreHistory::create($data_history);

            $model = ProductCore::where('product_code', $product_code)->first();

            $others = [
                'activity_type' => self::UPDATE,
                'platform' => self::PLATFORM
            ];

            $this->productActivityRepository->storeProductActivity($data_request, $others, $model);
            $model->update($data_request);
            /**
             * Commenting reset redis key code according to BL requirement on 24 June 2021
             */
            //$this->resetProductRedisKeys();
            $this->syncSearch();

            DB::commit();

            // Remove redis key if you have any changes in is_popular_pack
            $prepaidRedisKey = "prepaid_popular_pack";
            $postpaidRedisKey = "postpaid_popular_pack";
            ($request->pack_type == "PREPAID") ? Redis::del($prepaidRedisKey) : Redis::del($postpaidRedisKey);
        } catch (Exception $e) {

            DB::rollback();
            throw new Exception($e->getMessage());
        }

        return Redirect::back()->with('success', 'Product updated Successfully');
    }

    /**
     * Update my-bl products
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function storeMyblProducts($request)
    {
        $data['product_code'] = strtoupper(str_replace(' ', '', $request->product_code));

        if ($request->file('media')) {
            $file = $request->media;
            $path = $file->storeAs(
                'products/images',
                $data['product_code'] . '_' . strtotime(now()) . '.' . $file->getClientOriginalExtension(),
                'public'
            );

            $data['media'] = $path;
        }/* else {
            $data['media'] = null;
        }*/

        $firstTag = ProductTag::where('id', $request->tags[0])->first();
        $data['tag'] = isset($firstTag->title) ? $firstTag->title : null;
        $data['tag_bgd_color'] = isset($firstTag) ? $firstTag->tag_bgd_color : null;
        $data['tag_text_color'] = isset($firstTag) ? $firstTag->tag_text_color : null;
        $data['show_in_home'] = isset($request->show_in_app) ? true : false;
        $data['is_rate_cutter_offer'] = isset($request->is_rate_cutter_offer) ? true : false;
        $data['is_favorite'] = isset($request->is_favorite) ? true : false;
        $data['show_from'] = $request->show_from ? Carbon::parse($request->show_from)->format('Y-m-d H:i:s') : null;
        $data['hide_from'] = $request->hide_from ? Carbon::parse($request->hide_from)->format('Y-m-d H:i:s') : null;
        $data['is_visible'] = $request->is_visible;
        $data['is_popular_pack'] = $request->is_popular_pack ?? 0;
        $data['status'] = $request->status ?? 0;
        $data['pin_to_top'] = isset($request->pin_to_top) ? true : false;
        $data['is_banner_schedule'] = isset($request->is_banner_schedule) ? true : false;
        $data['is_tags_schedule'] = isset($request->is_tags_schedule) ? true : false;
        $data['is_visible_schedule'] = isset($request->is_visible_schedule) ? true : false;
        $data['is_pin_to_top_schedule'] = isset($request->is_pin_to_top_schedule) ? true : false;
        $data['is_base_msisdn_group_id_schedule'] = isset($request->is_base_msisdn_group_id_schedule) ? true : false;
        $data['base_msisdn_group_id'] = $request->base_msisdn_group_id;
        $data['special_type'] = isset($request->special_type) ? $request->special_type : null;


        $productSchedule = [];
        $isProductSchedule = false;

        if($data['is_banner_schedule'] == true) {
            if ($request->file('schedule_media')) {
                $file = $request->schedule_media;
                $path = $file->storeAs(
                    'products/images',
                    $data['product_code'] . '_' . strtotime(now()) . '.' . $file->getClientOriginalExtension(),
                    'public'
                );
                $productSchedule['media'] = $path;
            }
            $isProductSchedule = true;
        }

        if ($data['is_tags_schedule'] == true) {
            $productSchedule['tags'] = json_encode($request->schedule_tags);
            $isProductSchedule = true;
        }

        if ($data['is_visible_schedule'] == true) {
            $productSchedule['is_visible'] = $request->schedule_visibility;
            $isProductSchedule = true;
        }

        if ($data['is_pin_to_top_schedule'] == true) {
            $productSchedule['pin_to_top'] = $request->schedule_pin_to_top;
            $isProductSchedule = true;
        }

        if ($data['is_base_msisdn_group_id_schedule'] == true) {
            $productSchedule['base_msisdn_group_id'] = $request->schedule_base_msisdn_groups_id;
            $isProductSchedule = true;
        }

        if($isProductSchedule == true) {
            $productSchedule['start_date'] = Carbon::parse($request->start_date)->format('Y-m-d H:i:s');
            $productSchedule['end_date'] = Carbon::parse($request->end_date)->format('Y-m-d H:i:s');
        }
        if ($request->content_type == "data") {
            if (isset($request->offer_section_slug)) {
                $firstTab = MyBlInternetOffersCategory::findOrFail($request->offer_section_slug[0]);
            }
            $data['offer_section_title'] = isset($firstTab) ? $firstTab->name : 'Power Pack';
            $data['offer_section_slug'] = isset($firstTab) ? $firstTab->slug : 'power_pack';
        }

        try {
            DB::beginTransaction();

            $this->myBlProductRepository->save($data);

            if ($isProductSchedule == true) {
                $productSchedule['product_code'] = $data['product_code'];
                $this->myblProductScheduleRepository->save($productSchedule);
            }

            if ($request->has('tags')) {
                $this->syncProductTags($data['product_code'], $request->tags);
            }

            if ($request->has('offer_section_slug')) {
                foreach ($request->offer_section_slug ?? [] as $offerSectionId) {
                    $data_section_slug['product_code'] = $data['product_code'];
                    $data_section_slug['my_bl_internet_offers_category_id'] = $offerSectionId;
                    MyBlProductTab::create($data_section_slug);
                }
            }

            $data_request = $request->all();
            unset($data_request['_token']);
            unset($data_request['_method']);
            unset($data_request['tags']);
            unset($data_request['media']);
            unset($data_request['show_in_app']);
            unset($data_request['is_rate_cutter_offer']);
            unset($data_request['offer_section_slug']);
            unset($data_request['offer_section_title']);
            unset($data_request['show_from']);
            unset($data_request['hide_from']);
            unset($data_request['is_visible']);
            unset($data_request['pin_to_top']);

            $data_request['product_code'] = strtoupper(str_replace(' ', '', $request->product_code));
            $data_request['renew_product_code'] = strtoupper(str_replace(' ', '', $request->auto_renew_code));
            $data_request['recharge_product_code'] = strtoupper(str_replace(' ', '', $request->recharge_product_code));

            $data_request['platform'] = 'app';
            $data_request['validity_unit'] = $request['validity_unit'];

            if (isset($request->internet_volume_mb)) {
                $data_request['data_volume_unit'] = $request['data_volume_unit'];
                $data_request['internet_volume_mb'] = ($request['data_volume_unit'] == "GB") ? $request['internet_volume_mb'] * 1024 : $request['internet_volume_mb'];
                $data_request['data_volume'] = $request['internet_volume_mb'];
            }

            $others = [
                'activity_type' => self::CREATE,
                'platform' => self::PLATFORM
            ];
            $this->productActivityRepository->storeProductActivity($data_request, $others);

            $this->save($data_request);

            /**
             * Commenting reset redis key code according to BL requirement on 24 June 2021
             */
            //$this->resetProductRedisKeys();
            $this->syncSearch();

            DB::commit();

            $prepaidRedisKey = "prepaid_popular_pack";
            $postpaidRedisKey = "postpaid_popular_pack";
            ($request->sim_type == "1") ? Redis::del($prepaidRedisKey) : Redis::del($postpaidRedisKey);
        } catch (Exception $e) {
            DB::rollback();
            throw new Exception($e->getMessage());
        }
        return Redirect::route('mybl.product.index')->with('success', 'Product updated Successfully');
    }

    public function downloadMyblProducts()
    {
        $products = MyBlProduct::whereHas('details')->with('details', 'detailTabs')->where('status', 1)->get();

        $products = $products->sortBy('details.content_type');

        $writer = WriterEntityFactory::createXLSXWriter();

        $writer->openToBrowser('mybl-active-products-' . date('Y-m-d') . '.xlsx');

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

        // array_pop($headers);

        $row = WriterEntityFactory::createRowFromArray(array_values($headers), $header_style);
        $writer->addRow($row);

        $problem = [];

        foreach ($products as $product) {
            if ($product->details) {
                $insert_data[0] = ($product->details->sim_type == 2) ? 'Postpaid' : 'Prepaid';
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
                $insert_data[22] = strtolower($insert_data[1]) !== 'data' ? $product->offer_section_title : (implode(
                    ',',
                    $product->detailTabs->pluck('name')->where('platform', 'mybl')->toArray()
                ) ?: $product->offer_section_title);
                $productTags = $product->tags;
                $insert_data[23] = $productTags->count() ? implode(',',
                    $productTags->pluck('title')->toArray()) : $product->tag;
                $insert_data[24] = $product->details->call_rate;
                $insert_data[25] = $product->details->call_rate_unit;
                $insert_data[26] = $product->details->display_sd_vat_tax;
                $insert_data[27] = $product->details->display_title_en;
                $insert_data[28] = $product->details->display_title_bn;
                $insert_data[29] = $product->details->points;
                $insert_data[30] = ($product->is_visible) ? 'Yes' : 'No';
                $insert_data[31] = is_null($product->show_from) ? '' : Carbon::parse($product->show_from)->format('d-m-Y h:i A');
                $insert_data[32] = is_null($product->hide_from) ? '' : Carbon::parse($product->hide_from)->format('d-m-Y h:i A');
                $insert_data[33] = ($product->status) ? 'Yes' : 'No';

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

    public function syncProductTags($productCode, $tags)
    {
        $this->myBlProductTagRepository->deleteByProductCode($productCode);

        foreach ($tags ?? [] as $tag) {
            $this->myBlProductTagRepository->save([
                'product_code' => $productCode,
                'product_tag_id' => $tag
            ]);
        }
    }

    public function resetProductRedisKeys(): void
    {
        $pattern = Str::slug(env('REDIS_PREFIX', 'laravel'), '_') . '_database_';
        $keys = Redis::keys('available_products:*');
        $values = [];

        foreach ($keys as $key) {
            $values [] = str_replace($pattern, '', $key);
        }
        if (!empty($values)) {
            Redis::del($values);
            Log::info('Redis key for available_products has been reset at:' . Carbon::now()->toDateTimeString() .
                ' by user id : ' . Auth::id() . '. Total no of deleted key = ' . count($keys)
            );
        }
    }

    public function syncSearch(): void
    {
        try {
            Artisan::call('sync:search:offers');
        } catch (Exception $exception) {
            Log::error('Product Search Content Generation Error');
        }
    }

    public function imgRemove($id)
    {
        try {
            $product = $this->myBlProductRepository->findOne($id);
            if (!empty($product->media)) {
                unlink('storage/' . $product->media);
            }
            $product->media = null;
            $product->update();

            return [
                'status' => "success",
                'massage' => "Image removed successfully"
            ];
        } catch (Exception $exception) {
            return [
                'status' => "failed",
                'massage' => $exception->getMessage()
            ];
        }
    }

    public function findAllPinToTopProducts()
    {
        $orderBy = ['column' => 'pin_to_top_sequence', 'direction' => 'ASC'];
        return $this->myBlProductRepository->findBy(['pin_to_top' => true], null, $orderBy);
    }

    public function tableSort($request)
    {
        try {
            $positions = $request->position;

            foreach ($positions as $position) {
                $menu_id = $position[0];
                $new_position = $position[1];
                $update_menu = $this->myBlProductRepository->findOne($menu_id);
                $update_menu['pin_to_top_sequence'] = $new_position;
                $update_menu->update();
            }

            return [
                'status' => "success",
                'massage' => "Order Changed successfully"
            ];
        } catch (\Exception $exception) {
            $error = $exception->getMessage();
            return [
                'status' => "error",
                'massage' => $error
            ];
        }
    }
}

<?php

namespace App\Services;

use App\Models\MyBlInternetOffersCategory;
use App\Models\MyBlProduct;
use App\Models\Product;
use App\Models\ProductCore;
use App\Models\ProductCoreHistory;
use App\Models\ProductDetail;
use App\Repositories\ProductCoreRepository;
use App\Traits\CrudTrait;
use Box\Spout\Common\Type;
use Box\Spout\Reader\Common\Creator\ReaderFactory;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

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
    /**
     * @var array
     */

    protected $config;

    /**
     * ProductCoreService constructor.
     * @param  ProductCoreRepository  $productCoreRepository
     */
    public function __construct(ProductCoreRepository $productCoreRepository)
    {
        $this->productCoreRepository = $productCoreRepository;
        $this->setActionRepository($productCoreRepository);
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
        $productCode = $this->productCoreRepository
            ->findByProperties(['product_code' => $data['product_code']])
            ->first();
        if (empty($productCode)) {
            $data['name'] = $data['name_en'];
            $data['product_code'] = str_replace(' ', '', strtoupper($data['product_code']));
            $data['mrp_price'] = $data['price'] + $data['vat'];
//            $data['is_recharge_offer'] = $data['is_recharge'];
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
        return $this->productCoreRepository->findWithProduct($id);
    }

    /**
     * @param $data
     * @param $id
     */
    public function updateProductCore($data, $id)
    {
        $product = $this->productCoreRepository->findOneProductCore($id);
        $data['mrp_price'] = round($data['price'] + $data['vat']);
        $product->update($data);
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
                                case "family_name":
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
                                        $sim_type = null;
                                    }
                                    $core_data [$field] = $sim_type;
                                    break;
                                case "is_auto_renewable":
                                case "is_recharge_offer":
                                    $type = strtolower($cells [$index]->getValue());
                                    if ($type == 'yes') {
                                        $flag = 1;
                                    } elseif ($type == 'no') {
                                        $flag = 0;
                                    } else {
                                        break;
                                    }
                                    $core_data[$field] = $flag;
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
                                case "is_rate_cutter_offer":
                                case "is_amar_offer":
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
                                case "offer_section_title":
                                    $title = $cells [$index]->getValue();
                                    $mybl_data[$field] = $title;
                                    $mybl_data['offer_section_slug'] = str_replace(' ', '_', strtolower($title));
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
                            $core_product = ProductCore::where('product_code', $product_code)->first();

                            if ($core_product) {
                                if ($core_product->platform == 'web') {
                                    $core_data ['platform'] = 'all';
                                }
                            } else {
                                $core_data['platform'] = 'app';
                            }

                            //dd($core_data);

                            ProductCore::updateOrCreate([
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
        if ($request->status) {
            $builder = MyBlProduct::where('status', $request->status);
        }
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
                        $q->where('is_recharge_offer', '<>', 1);
                        $q->whereNull('call_rate');
                    } elseif ($request->content_type == 'recharge_offer') {
                        $q->whereNotNull('recharge_product_code');
                    } elseif ($request->content_type == 'rate_cutter') {
                        $q->whereNotNull('call_rate');
                    } else {
                        $q->where('content_type', $request->content_type);
                    }
                }
            }
        );

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
                                case "family_name":
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
                                    $core_data [$field] = $cells [$index]->getValue();
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
                                case "validity_in_days":
                                    $validity = $cells [$config['validity']]->getValue();
                                    $unit = $cells [$config['validity_unit']]->getValue();
                                    if (strtolower($unit) == 'hours') {
                                        $validity = round($validity / 24);
                                    }
                                    $core_data [$field] = ($validity == "") ? null : $validity;
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
                                    $core_data [$field] = $giftOffer;
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
                            $core_product = ProductCore::where('product_code', $product_code)->first();

                            if ($core_product) {
                                if ($core_product->platform == 'app') {
                                    $core_data ['platform'] = 'all';
                                }
                            } else {
                                $core_data['platform'] = 'web';
                            }

//                            dd($core_data);

                            ProductCore::updateOrCreate([
                                'product_code' => $product_code
                            ], $core_data);

                            if ($assetLiteProduct['offer_category_id']) {
                                $productId = Product::updateOrCreate([
                                    'product_code' => $product_code
                                ], $assetLiteProduct);
                                ProductDetail::updateOrCreate([
                                    'product_id' => $productId->id
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
        return MyBlProduct::with('details')->where('product_code', $product_code)->first();
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
                $product_code . '.' . $file->getClientOriginalExtension(),
                'public'
            );

            $data['media'] = $path;
        }

        if ($request->has('offer_section_slug')) {
            $data['offer_section_slug'] = $request->offer_section_slug;
            $offer = MyBlInternetOffersCategory::where('slug', $request->offer_section_slug)->first();
            $data['offer_section_title'] = $offer->name;
        }
        $data['tag'] = $request->tag;
        $data['show_in_home'] = isset($request->show_in_app) ? true : false;
        $data['is_rate_cutter_offer'] = isset($request->is_rate_cutter_offer) ? true : false;

        try{

            DB::beginTransaction();

            MyBlProduct::where('product_code', $product_code)->update($data);

            $core_product = ProductCore::where('product_code', $product_code)->get()->toArray();

            $data_request = $request->all();
            unset($data_request['_token']);
            unset($data_request['_method']);
            unset($data_request['tag']);
            unset($data_request['show_in_app']);
            unset($data_request['is_rate_cutter_offer']);
            unset($data_request['offer_section_slug']);
            unset($data_request['offer_section_title']);

            if(isset($data_request['data_volume'])){
                $data_request['data_volume'] = substr($data_request['data_volume'], 0, strrpos($data_request['data_volume'], ' '));
            }

            if(isset($data_request['sms_volume'])){
                $data_request['sms_volume'] = substr($data_request['sms_volume'], 0, strrpos($data_request['sms_volume'], ' '));
            }

            if(isset($data_request['minute_volume'])){
                $data_request['minute_volume'] = substr($data_request['minute_volume'], 0, strrpos($data_request['minute_volume'], ' '));
            }

            if(isset($data_request['validity'])){
                $data_request['validity'] = substr($data_request['validity'], 0, strrpos($data_request['validity'], ' '));
            }

            $data_history = $core_product[0];

            $data_history['created_by'] = Auth::user()->id;

            $data_history['product_core_id'] = $core_product[0]['id'];

            ProductCoreHistory::create($data_history);

            ProductCore::where('product_code', $product_code)->update($data_request);

            DB::commit();

        } catch(Exception $e){
            DB::rollback();
            throw new Exception( $e->getMessage());
        }

        return Redirect::back()->with('success', 'Product updated Successfully');
    }
}

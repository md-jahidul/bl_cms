<?php


namespace App\Services;

use App\Repositories\BannerAnalyticRepository;
use App\Repositories\SliderImageRepository;
use App\Repositories\BannerAnalyticDetailsRepository;
use App\Models\BannerProductPurchase;
use App\Services\MyblSliderImageService;
use App\Traits\CrudTrait;
use DataTables;
use Carbon\Carbon;
use DB;

class BannerAnalyticService
{

    use CrudTrait;

    /**
     * @var BannerAnalyticRepository
     */
    protected $bannerAnalyticRepository;

    /**
     * @var SliderImageRepository
     */
    protected $sliderImageRepository;

    /**
     * @var MyblSliderImageService
     */
    protected $myblSliderImageService;

    /**
     * @var BannerAnalyticDetailsRepository
     */
    protected $bannerAnalyticDetailsRepository;

    /**
     * BannerAnalyticService constructor.
     * @param BannerAnalyticRepository $bannerAnalyticRepository
     * @param BannerAnalyticDetailsRepository $bannerAnalyticDetailsRepository
     */
    public function __construct(
        BannerAnalyticRepository $bannerAnalyticRepository,
        BannerAnalyticDetailsRepository $bannerAnalyticDetailsRepository,
        SliderImageRepository $sliderImageRepository,
        MyblSliderImageService $myblSliderImageService
    )
    {
        $this->bannerAnalyticRepository = $bannerAnalyticRepository;
        $this->myblSliderImageService = $myblSliderImageService;
        $this->sliderImageRepository = $sliderImageRepository;
        $this->bannerAnalyticDetailsRepository = $bannerAnalyticDetailsRepository;
        $this->setActionRepository($bannerAnalyticRepository);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function bannerAnaliticReporFilterData($request)
    {

        $searchByFromdate = ($request->has('searchByFromdate')) ? $request->input('searchByFromdate') : null;
        $searchByTodate = ($request->has('searchByTodate')) ? $request->input('searchByTodate') : null;
        $detailsData = $this->bannerAnalyticDetailsRepository->getCountsByActionType(
            $searchByFromdate,
            $searchByTodate
        );
        $purchaseDetailsData = $this->bannerAnalyticDetailsRepository->getPurchaseCountsByActionType(
            $searchByFromdate,
            $searchByTodate
        );
//dd($purchaseDetailsData);
        $from = is_null($searchByFromdate) ? Carbon::now()->subMonths(1)->toDateString() . ' 00:00:00' : Carbon::createFromFormat('Y-m-d H:i:s', $searchByFromdate . ' 00:00:00')->toDateTimeString();
        $to = is_null($searchByTodate) ? Carbon::now()->toDateString() . ' 23:59:59' : Carbon::createFromFormat('Y-m-d H:i:s', $searchByTodate . '23:59:59')->toDateTimeString();
        $data = $this->bannerAnalyticRepository->getBannerAnalytic($from, $to);

        $result = [];
        foreach ($data as $key => $log) {
            $stTime = (!empty($log->getSliderImage->start_date)) ? date('d-m-Y', strtotime($log->getSliderImage->start_date)) : '';
            $enTime = (!empty($log->getSliderImage->end_date)) ? date('d-m-Y', strtotime($log->getSliderImage->end_date)) : '';
            $result[$key]['id'] = $log->id;
            $result[$key]['banner_id'] = $log->slider_id;
//            $result[$key]['banner_image_name'] = $log->getSliderImage->titel;
            $result[$key]['banner_name'] = $log->getSlider->title;
            $result[$key]['banner_image_name'] = $log->getSliderImage->title;
            $result[$key]['image'] = $log->getSliderImage->image_url;
            $result[$key]['view_count'] = $log->view_count;
            $result[$key]['click_count'] = $log->view_count;
            $result[$key]['schedule_date'] = $stTime . '  -> ' . $enTime;
            $result[$key]['totalDuration'] = $this->scheduleDateCalculaton([
                'start_date' => $log->getSliderImage->start_date,
                'end_date' => $log->getSliderImage->end_date,
                'created_at' => $log->getSliderImage->created_at,
            ]);
            $detailsDatum = $detailsData
                ->where('banner_analytic_id', $log->id)
                ->flatten()
                ->toArray();
            $purchaseDetailsDatum = $purchaseDetailsData
                ->where('slider_id', $log->slider_id)
                ->where('slider_image_id', $log->slider_image_id)
                ->flatten()
                ->toArray();
            $array1 = json_decode(json_encode($detailsDatum), true);
            $array2 = json_decode(json_encode($purchaseDetailsDatum), true);
            $proceshData = collect([$array1, $array2]);
            $result[$key]['log'] = $this->preparePurchaseFilteredCount($proceshData);
        }
        return Datatables::collection($result)
            ->addIndexColumn()
            ->addColumn('banner_image_name', function ($result) use ($from, $to) {

                $url = route('banner-analytic.report.details', $result['id']);
                $actionBtn = '<a href="' . $url . '?from=' . $from . '&to=' . $to . '&banner_id=2">' . $result['banner_image_name'] . '</a>';

                return $actionBtn;
            })
            ->addColumn('image', function ($result) {
                return $image = '<img src="' .asset($result['image']) . '" style="max-width: 100px;">';

            })
            ->addColumn('tview', function ($result) {
                return $result['log']['click'] + $result['log']['total_buy'] + $result['log']['total_buy_attempt'] + $result['log']['total_cancel'];

            })
            ->addColumn('click_count', function ($result) use ($from, $to) {

                $url = route('banner-analytic.purchase.report.details', $result['log']['product_purchases_id']);
                $actionBtn = '<a href="' . $url . '?from=' . $from . '&to=' . $to . '&banner_id=2">' . $result['log']['click'] . '</a>';

                return $actionBtn;
            })
            ->addColumn('total_buy', function ($result) use ($from, $to) {
                if ($result['log']['product_purchases_id'] !== 0) {
                    $url = route('banner-analytic.purchase.report.details', $result['log']['product_purchases_id']);
                    $actionBtn = '<a href="' . $url . '?from=' . $from . '&to=' . $to . '">' . $result['log']['total_buy'] . '</a>';
                } else {
                    $actionBtn = $result['log']['total_buy'];
                }
                return $actionBtn;
            })
            ->addColumn('buy_attempt', function ($result) use ($from, $to) {
                if ($result['log']['product_purchases_id'] !== 0) {
                    $url = route('banner-analytic.purchase.report.details', $result['log']['product_purchases_id']);
                    $actionBtn = '<a href="' . $url . '?from=' . $from . '&to=' . $to . '">' . $result['log']['total_buy_attempt'] . '</a>';
                } else {
                    $actionBtn = $result['log']['total_cancel'];
                }
                return $actionBtn;
            })
            ->addColumn('total_cancel', function ($result) use ($from, $to) {
                if ($result['log']['product_purchases_id'] !== 0) {
                    $url = route('banner-analytic.purchase.report.details', $result['log']['product_purchases_id']);
                    $actionBtn = '<a href="' . $url . '?from=' . $from . '&to=' . $to . '">' . $result['log']['total_cancel'] . '</a>';
                } else {
                    $actionBtn = $result['log']['total_cancel'];
                }
                return $actionBtn;
            })
//            ->addColumn('action', function ($result) use ($from, $to) {
//                $url = route('banner-analytic.report.details', $result['id']);
//                if ($result['log']['product_purchases_id'] !== 0) {
//                    $url2 = route('banner-analytic.purchase.report.details', $result['log']['product_purchases_id']);
//                    $actionBtn = '<a href="' . $url . '?from=' . $from . '&to=' . $to . '&banner_id=2" class="edit btn btn-success btn-sm">view</a>' .
//                        '<a href="' . $url2 . '?from=' . $from . '&to=' . $to . '&banner_id=2" class="edit btn btn-info btn-sm">Puchase</a>';
//                } else {
//                    $actionBtn = '<a href="' . $url . '?from=' . $from . '&to=' . $to . '&banner_id=2" class="edit btn btn-success btn-sm">view</a>';
//                }
//                return $actionBtn;
//            })
            ->rawColumns(['banner_image_name', 'click_count', 'total_buy', 'buy_attempt', 'total_cancel', 'image'])
            ->make(true);
    }

    public function numberOfActiveBanner()
    {
        return $this->sliderImageRepository->findBy(['is_active' => 1])->count();
    }

    public function numberOfPurchase($totalBuy = 'total_buy')
    {
        return BannerProductPurchase::sum("$totalBuy");
//        return BannerProductPurchase::select(DB::Raw("SUM(total_buy)"))->get();
    }

    /**
     * @param $date
     * @return string
     */
    public function scheduleDateCalculaton($date)
    {

        if (!empty($date['start_date']) and !empty($date['end_date'])) {
            $startTime = Carbon::parse($date['start_date']);
            $finishTime = Carbon::parse($date['end_date']);
            $totalDuration = $finishTime->diffAsCarbonInterval($startTime);
        } elseif (empty($date['start_date']) and !empty($date['end_date'])) {
            $startTime = Carbon::parse($date['created_at']);
            $finishTime = Carbon::parse($date['end_date']);
            $totalDuration = $finishTime->diffAsCarbonInterval($startTime);
        } elseif (!empty($date['start_date']) and empty($date['end_date'])) {
            $startTime = Carbon::parse($date['start_date']);
            $finishTime = Carbon::now();
            $totalDuration = $finishTime->diffAsCarbonInterval($startTime);
        } else {
            $totalDuration = 'No Schedule';
        }
        if ($totalDuration !== 'No Schedule') {
            $date1 = Carbon::createFromFormat('Y-m-d H:i:s', $startTime);
            $date2 = Carbon::createFromFormat('Y-m-d H:i:s', $finishTime);

            $totalDuration = $date1->diffAsCarbonInterval($date2, true);
            if ($date1->gt($date2)) {
                $totalDuration = $totalDuration . ' ';
            } else {
                $totalDuration = $totalDuration . ' ';
            }
        }
        return $totalDuration;

    }

    /**
     * @param $request
     * @return mixed
     */

    public function bannerAnaliticReportData($request)
    {
        $data = $this->findAll();
        $searchByFromdate = ($request->has('searchByFromdate')) ? $request->input('searchByFromdate') : null;
        $searchByTodate = ($request->has('searchByTodate')) ? $request->input('searchByTodate') : null;
        $from = is_null($searchByFromdate) ? Carbon::now()->subMonths(1)->toDateString() . ' 00:00:00' : Carbon::createFromFormat('Y-m-d H:i:s', $searchByFromdate . ' 00:00:00')->toDateTimeString();
        $to = is_null($searchByTodate) ? Carbon::now()->toDateString() . ' 23:59:59' : Carbon::createFromFormat('Y-m-d H:i:s', $searchByTodate . '23:59:59')->toDateTimeString();
        $result = [];
        foreach ($data as $key => $log) {
            $stTime = (!empty($log->getSliderImage->start_date)) ? date('d-m-Y', strtotime($log->getSliderImage->start_date)) : '';
            $enTime = (!empty($log->getSliderImage->end_date)) ? date('d-m-Y', strtotime($log->getSliderImage->end_date)) : '';
            $result[$key]['id'] = $log->id;
            $result[$key]['banner_name'] = $log->getSlider->title ?? '';
            $result[$key]['banner_image_name'] = $log->getSliderImage->title ?? '';
            $result[$key]['image'] = $log->getSliderImage->image_url ?? '';
            $result[$key]['view_count'] = $log->view_count ?? '0';
            $result[$key]['click_count'] = $log->view_count ?? '0';
            $result[$key]['schedule_date'] = $stTime . '  -> ' . $enTime;
            $result[$key]['totalDuration'] = $this->scheduleDateCalculaton([
                'start_date' => $log->getSliderImage->start_date ?? '',
                'end_date' => $log->getSliderImage->end_date ?? '',
                'created_at' => $log->getSliderImage->created_at ?? '',
            ]);
            $result[$key]['log']['total_buy'] = !empty($log->getBannePurchases->total_buy) ? $log->getBannePurchases->total_buy : 0;
            $result[$key]['log']['total_buy_attempt'] = !empty($log->getBannePurchases->total_buy_attempt) ? $log->getBannePurchases->total_buy_attempt : 0;
            $result[$key]['log']['total_cancel'] = !empty($log->getBannePurchases->total_cancel) ? $log->getBannePurchases->total_cancel : 0;
            $result[$key]['log']['product_purchases_id'] = !empty($log->getBannePurchases->id) ? $log->getBannePurchases->id : 0;
        }
        return Datatables::collection($result)
            ->addIndexColumn()
            ->addColumn('banner_image_name', function ($result) {
                $url = route('banner-analytic.report.details', $result['id']);
                $actionBtn = '<a href="' . $url . '">' . $result['banner_image_name'] . '</a>';
                return $actionBtn;
            })
            ->addColumn('image', function ($result) {
                return $image = '<img src="' . asset($result['image']). '" style="max-width: 100px;">';

            })
            ->addColumn('tview', function ($result) {
                return $result['click_count'] + $result['log']['total_buy'] + $result['log']['total_buy_attempt'] + $result['log']['total_cancel'];
            })
            ->addColumn('click_count', function ($result) {
                $url = route('banner-analytic.report.details', $result['id']);
                $actionBtn = '<a href="' . $url . '">' . $result['click_count'] . '</a>';
                return $actionBtn;

            })
            ->addColumn('total_buy', function ($result) {
                $url = route('banner-analytic.purchase.report.details', $result['log']['product_purchases_id']);
                $actionBtn = '<a href="' . $url . '">' . $result['log']['total_buy'] . '</a>';
                return $actionBtn;
            })
            ->addColumn('buy_attempt', function ($result) {
                $url = route('banner-analytic.purchase.report.details', $result['log']['product_purchases_id']);
                $actionBtn = '<a href="' . $url . '">' . $result['log']['total_buy_attempt'] . '</a>';
                return $actionBtn;
            })
            ->addColumn('total_cancel', function ($result) {
                $url = route('banner-analytic.purchase.report.details', $result['log']['product_purchases_id']);
                $actionBtn = '<a href="' . $url . '">' . $result['log']['total_cancel'] . '</a>';
                return $actionBtn;
            })
            ->rawColumns(['banner_image_name', 'click_count', 'total_buy', 'buy_attempt', 'total_cancel', 'image'])
            ->make(true);
    }

    /**
     * @param $detailsDatum
     * @return array
     */
    public function prepareFilteredCount($detailsDatum)
    {
        if (empty($detailsDatum)) {
            $array['total_buy'] = 0;
            $array['total_cancel'] = 0;
            $array['total_buy_attempt'] = 0;

        } else {
            $total_buy_attempt = 0;
            $total_cancel = 0;
            $total_buy = 0;
            foreach ($detailsDatum as $infolog) {
                if ($infolog['action_type'] == 'buy_failure') {
                    $total_buy_attempt = +$infolog['total_count'];
                }
                if ($infolog['action_type'] == 'buy_success') {
                    $total_buy = +$infolog['total_count'];
                }
                if ($infolog['action_type'] == 'cancel') {
                    $total_cancel = +$infolog['total_count'];
                }
            }
            $array['total_buy_attempt'] = $total_buy_attempt;
            $array['total_cancel'] = $total_cancel;
            $array['total_buy'] = $total_buy;

        }

        return $array;

    }

    /**
     * @param $detailsDatum
     * @return array
     */
    public function preparePurchaseFilteredCount($detailsDatum)
    {
//        dd($detailsDatum);
        if (empty($detailsDatum)) {
            $array['total_buy'] = 0;
            $array['total_cancel'] = 0;
            $array['total_buy_attempt'] = 0;
            $array['click'] = 0;
            $array['slider_id'] = 0;
            $array['product_purchases_id'] = 0;
        } else {
            $total_buy_attempt = 0;
            $total_cancel = 0;
            $total_buy = 0;
            $click = 0;
            $banner_id = 0;
            $product_purchases = 0;
            foreach ($detailsDatum as $key => $infolog) {
                if (!empty($infolog[0])) {
                    foreach ($infolog as $key => $info) {

                        if ($info['action_type'] == 'buy_failure') {
                            $total_buy_attempt = +$info['total_count'];
                        }
                        if ($info['action_type'] == 'buy_success') {
                            $total_buy = +$info['total_count'];
                        }
                        if ($info['action_type'] == 'cancel') {
                            $total_cancel = +$info['total_count'];
                        }
                        if ($info['action_type'] == 'click') {
                            $click = +$info['total_count'];
                        }
                        if (isset($info['banner_product_purchase_id'])) {
                            $product_purchases = $info['banner_product_purchase_id'];
                        }

                        $banner_id = $info['slider_id'];
                    }
                }
            }
            $array['total_buy_attempt'] = $total_buy_attempt;
            $array['total_cancel'] = $total_cancel;
            $array['total_buy'] = $total_buy;
            $array['click'] = $click;
            $array['slider_id'] = $banner_id;
            $array['product_purchases_id'] = $product_purchases;
        }
        return $array;
    }


    /**
     * @param $id
     * @param $request
     * @return mixed
     */
    public function bannerAnaliticDetailReportData($id, $request)
    {
        if (!empty($request->input('from')) && !empty($request->input('to'))) {
            $from = Carbon::createFromFormat('Y-m-d H:i:s', $request->input('from') . '00:00:00')->toDateTimeString();
            $to = Carbon::createFromFormat('Y-m-d H:i:s', $request->input('to') . '23:59:59')->toDateTimeString();

            $data = $this->bannerAnalyticDetailsRepository->getDetailsByIdDateTodate($id, $from, $to);
            //            $data = AgentDeeplinkDetail::->get();
        } else {
            $from = Carbon::now()->subMonths(1)->toDateString() . ' 00:00:00';
            $to = Carbon::now()->toDateString() . ' 23:59:59';
            $data = $this->bannerAnalyticDetailsRepository->getDetailsByIdDateTodate($id, $from, $to);
        }
        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('session_time', function ($data) {
                if (!empty($data->session_time)) {
                    $session_time = $data->session_time / 1000 . ' Sec';
                } else {
                    $session_time = $data->session_time;
                }
                return $session_time;
            })
            ->editColumn('slider_name', function ($data) {
                return $data->getAnalyticInfo->getSlider->title;
            })
            ->editColumn('slider_image_name', function ($data) {
                return $data->getAnalyticInfo->getSliderImage->title;
            })
            ->editColumn('date', function ($data) {
                return date('d-m-Y H:i:s', strtotime($data->created_at));
            })
            ->rawColumns(['date'])
            ->make(true);
    }

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @param [type] $request
     * @return void
     */
    public function bannerAnaliticPurchaseDetailReportData($id, $request)
    {
        if (!empty($request->input('from')) && !empty($request->input('to'))) {
            $from = Carbon::createFromFormat('Y-m-d H:i:s', $request->input('from') . '00:00:00')->toDateTimeString();
            $to = Carbon::createFromFormat('Y-m-d H:i:s', $request->input('to') . '23:59:59')->toDateTimeString();

            $data = $this->bannerAnalyticDetailsRepository->getPurchaseDetailsByIdDateTodate($id, $from, $to);

        } else {
            $from = Carbon::now()->subMonths(1)->toDateString() . ' 00:00:00';
            $to = Carbon::now()->toDateString() . ' 23:59:59';
            $data = $this->bannerAnalyticDetailsRepository->getPurchaseDetailsByIdDateTodate($id, $from, $to);
        }
        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('date', function ($data) {
                return date('d-m-Y H:i:s', strtotime($data->created_at));
            })
            ->editColumn('session_time', function ($data) {
                if(!empty($data->session_time)){
                    $time=$data->session_time/1000 ;//.'sec';
                }else{
                    $time=null;
                }
                return $time;
            })
            ->rawColumns(['date','session_time'])
            ->make(true);
    }

}

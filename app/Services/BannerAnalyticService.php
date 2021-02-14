<?php


namespace App\Services;

use App\Repositories\BannerAnalyticRepository;
use App\Repositories\BannerAnalyticDetailsRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;
use DataTables;
use Carbon\Carbon;

class BannerAnalyticService
{

    use CrudTrait;

    /**
     * @var BannerAnalyticRepository
     */
    protected $bannerAnalyticRepository;
    /**
     * @var BannerAnalyticDetailsRepository
     */
    protected $bannerAnalyticDetailsRepository;

    /**
     * BannerAnalyticService constructor.
     * @param BannerAnalyticRepository $bannerAnalyticRepository
     * @param BannerAnalyticDetailsRepository $bannerAnalyticDetailsRepository
     */
    public function __construct(BannerAnalyticRepository $bannerAnalyticRepository, BannerAnalyticDetailsRepository $bannerAnalyticDetailsRepository)
    {
        $this->bannerAnalyticRepository = $bannerAnalyticRepository;
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

        $from = is_null($searchByFromdate) ? Carbon::now()->subMonths(1)->toDateString() . ' 00:00:00' : Carbon::createFromFormat('Y-m-d H:i:s', $searchByFromdate . ' 00:00:00')->toDateTimeString();
        $to = is_null($searchByTodate) ? Carbon::now()->toDateString() . ' 23:59:59' : Carbon::createFromFormat('Y-m-d H:i:s', $searchByTodate . '23:59:59')->toDateTimeString();
        $data =  $this->bannerAnalyticRepository->getBannerAnalytic($from, $to);

        $result = [];
        foreach ($data as $key => $log) {
            $result[$key]['id'] = $log->id;
            $result[$key]['banner_name'] = $log->getBanner->name;
            $result[$key]['code'] = $log->getBanner->code;
            $result[$key]['view_count'] = $log->view_count;
            $result[$key]['click_count'] = $log->view_count;

            $detailsDatum = $detailsData
                ->where('banner_analytic_id', $log->id)
                ->flatten()
                ->toArray();
            $purchaseDetailsDatum = $purchaseDetailsData
            ->where('banner_id', $log->id)
            ->flatten()
            ->toArray();
            $array1 = json_decode(json_encode($detailsDatum), true);
            $array2 = json_decode(json_encode($purchaseDetailsDatum), true);
            $proceshData=collect([$array1,$array2]);
            $result[$key]['log'] = $this->preparePurchaseFilteredCount($proceshData);
        }

        return Datatables::collection($result)
            ->addIndexColumn()
            ->addColumn('tview', function ($result) {
                return $result['log']['click']+$result['log']['total_buy']+$result['log']['total_buy_attempt']+$result['log']['total_cancel'];
            })
            ->addColumn('click_count', function ($result) {
                return $result['log']['click'];
            })
            ->addColumn('total_buy', function ($result) {
                return $result['log']['total_buy'];
            })
            ->addColumn('buy_attempt', function ($result) {
                return $result['log']['total_buy_attempt'];
            })
            ->addColumn('total_cancel', function ($result) {
                return $result['log']['total_cancel'];
            })
            ->addColumn('action', function ($result) use ($from, $to) {
                $url = route('banner-analytic.report.details', $result['id']);
                $actionBtn = '<a href="' . $url . '?from=' . $from . '&to=' . $to . '" class="edit btn btn-success btn-sm">view</a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
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
        // $detailsData = $this->bannerAnalyticDetailsRepository->getCountsByActionType(
        //     $searchByFromdate,
        //     $searchByTodate
        // );

        $from = is_null($searchByFromdate) ? Carbon::now()->subMonths(1)->toDateString() . ' 00:00:00' : Carbon::createFromFormat('Y-m-d H:i:s', $searchByFromdate . ' 00:00:00')->toDateTimeString();
        $to = is_null($searchByTodate) ? Carbon::now()->toDateString() . ' 23:59:59' : Carbon::createFromFormat('Y-m-d H:i:s', $searchByTodate . '23:59:59')->toDateTimeString();
        $result = [];
        foreach ($data as $key => $log) {
            $result[$key]['id'] = $log->id;
            $result[$key]['banner_name'] = $log->getBanner->name;
            $result[$key]['code'] = $log->getBanner->code;
            $result[$key]['view_count'] = $log->view_count;
            $result[$key]['click_count'] = $log->view_count;

            // $detailsDatum = $detailsData
            //     ->where('banner_analytic_id', $log->id)
            //     ->flatten()
            //     ->toArray();

            $result[$key]['log']['total_buy'] = !empty($log->getBannePurchases->total_buy) ? $log->getBannePurchases->total_buy:0;
             //$this->prepareFilteredCount($detailsDatum);
            $result[$key]['log']['total_buy_attempt'] = !empty($log->getBannePurchases->total_buy_attempt) ? $log->getBannePurchases->total_buy_attempt:0;
            $result[$key]['log']['total_cancel'] = !empty($log->getBannePurchases->total_cancel) ? $log->getBannePurchases->total_cancel:0;

        }
        return Datatables::collection($result)
            ->addIndexColumn()
            ->addColumn('tview', function ($result) {
                return $result['click_count'] + $result['log']['total_buy'] + $result['log']['total_buy_attempt'] + $result['log']['total_cancel'];
            })
            ->addColumn('click_count', function ($result) {
                return $result['click_count'];
            })
            ->addColumn('total_buy', function ($result) {
                return $result['log']['total_buy'];
            })
            ->addColumn('buy_attempt', function ($result) {
                return $result['log']['total_buy_attempt'];
            })
            ->addColumn('total_cancel', function ($result) {
                return $result['log']['total_cancel'];
            })
            ->addColumn('action', function ($result) use ($from, $to) {
                $url = route('banner-analytic.report.details', $result['id']);
                $actionBtn = '<a href="' . $url . '" class="edit btn btn-success btn-sm">view</a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
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
        if (empty($detailsDatum)) {
            $array['total_buy'] = 0;
            $array['total_cancel'] = 0;
            $array['total_buy_attempt'] = 0;
            $array['click']=0;
            $array['banner_id'] = 0;
        } else {
            $total_buy_attempt = 0;
            $total_cancel = 0;
            $total_buy = 0;
            $click=0;
            $banner_id=0;
            foreach ($detailsDatum as $key=>$infolog) {
                if(!empty($infolog[0])){
                if ($infolog[0]['action_type'] == 'buy_failure') {
                    $total_buy_attempt = +$infolog[0]['total_count'];
                }
                if ($infolog[0]['action_type'] == 'buy_success') {
                    $total_buy = +$infolog[0]['total_count'];
                }
                if ($infolog[0]['action_type'] == 'cancel') {
                    $total_cancel = +$infolog[0]['total_count'];
                }
                if ($infolog[0]['action_type'] == 'click') {
                    $click = +$infolog[0]['total_count'];
                }
                $banner_id=$infolog[0]['banner_id'];
            }
            }
            $array['total_buy_attempt'] = $total_buy_attempt;
            $array['total_cancel'] = $total_cancel;
            $array['total_buy'] = $total_buy;
            $array['click']=$click;
            $array['banner_id'] = $banner_id;
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
            ->editColumn('banner_name', function ($data) {
                return $data->getAnalyticInfo->getBanner->name;
            })
            ->editColumn('date', function ($data) {
                return date('d-m-Y H:i:s', strtotime($data->created_at));
            })
            ->rawColumns(['date'])
            ->make(true);
    }
}

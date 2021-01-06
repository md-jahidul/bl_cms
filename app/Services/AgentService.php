<?php


namespace App\Services;

use App\Models\MyBlProduct;
use App\Models\ProductDeepLink;
use App\Services\FirebaseDeepLinkService;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;
use App\Models\AgentList;
use App\Models\AgentDeeplink;
use App\Models\AgentDeeplinkDetail;
use App\Repositories\AgentRepository;
use App\Repositories\AgentDeepLinkRepository;
use App\Repositories\AgentDeepLinkDetailsRepository;
use phpDocumentor\Reflection\Types\This;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Support\Facades\Crypt;
use DataTables;
use Carbon\Carbon;

class AgentService
{

    use CrudTrait;

    /**
     * @var $agentRepository
     */
    protected $agentRepository;

    /**
     * @var $agentDeepLinkRepository
     */
    protected $agentDeepLinkRepository;

    /**
     * @var $firebaseDeepLinkService
     */
    protected $firebaseDeepLinkService;

    /**
     * AgentService constructor.
     * @param AgentRepository $agentRepository
     * @param AgentDeepLinkRepository $agentDeepLinkRepository
     * @param FirebaseDeepLinkService $firebaseDeepLinkService
     * @param AgentDeepLinkDetailsRepository $agentDeepLinkDetailsRepository
     */
    public function __construct(
        AgentRepository $agentRepository,
        AgentDeepLinkRepository $agentDeepLinkRepository,
        FirebaseDeepLinkService $firebaseDeepLinkService,
        AgentDeepLinkDetailsRepository $agentDeepLinkDetailsRepository
    )
    {
        $this->agentRepository = $agentRepository;
        $this->agentDeepLinkRepository = $agentDeepLinkRepository;
        $this->firebaseDeepLinkService = $firebaseDeepLinkService;
        $this->agentDeepLinkDetailsRepository = $agentDeepLinkDetailsRepository;
        $this->setActionRepository($agentRepository);
    }

    /**
     * @return mixed
     */

    public function agentList()
    {
        return AgentList::where('is_delete', 0)->orderBy('id', 'desc')->get();
    }

    /**
     * @param $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function upateAgentInformation($request, $id)
    {

        $search = $this->findOne($id);
        $search->update($request);
        return Response('Agent Information has been successfully updated');

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function upateAgentStatus($id)
    {
        $search = $this->findOne($id);
        $status = ($search->is_active == 1) ? 0 : 1;
        $search->update(['is_active' => trim($status)]);
        return Response('Agent status has been successfully updated');
    }

    /**
     * @return string[]
     */
    public function deepLinkTypeList()
    {
        $list = ['product' => 'Product', 'signup' => 'Sign-up'];
        return $list;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function storeAgentDeeplink($request)
    {
        $productType = strtolower($request['deeplink_type']);
        if (strtolower($request['deeplink_type']) == 'signup') {
            $checkAgentSignupLink = $this->agentDeepLinkRepository->findOneBy(['deeplink_type' => 'signup', 'agent_id' => $request['agent_id'], 'is_delete' => 0]);

            if ($checkAgentSignupLink) {
                return new Response("Sorry, This agent signup link already generated ");
            } else {
                $product = $this->agentRepository->findOne($request['agent_id']);
                $product_code = uniqid('bl-agent-');//$product->msisdn;//Crypt::encryptString($product->msisdn);
                $request['product_code'] = $product_code;
            }
        }
        if (strtolower($request['deeplink_type']) == 'product') {

            $checkAgentDeepLink = $this->agentDeepLinkRepository->findOneBy(['product_code' => $request['product_code'], 'agent_id' => $request['agent_id'], 'is_delete' => 0]);

            if ($checkAgentDeepLink) {
                return new Response("Sorry, This agent deeplink already assigned ");
            } else {

                $product_code = $request['product_code'];
                $checkProduct = MyBlProduct::where('product_code', $product_code)->first();
                if (!$checkProduct) {
                    throw new NotFoundHttpException();
                }
            }
        }
        $agent_id = $request['agent_id'];
        $fullLink = "https://banglalink.net/agent/$agent_id/$productType/$product_code";
        $body = [
            "dynamicLinkInfo" => [
                "domainUriPrefix" => env('DOMAINURIPREFIX'),
                "link" => $fullLink,
                "androidInfo" => [
                    "androidPackageName" => "com.arena.banglalinkmela.app"
                ],
                "iosInfo" => [
                    "iosBundleId" => "com.Banglalink.My-Banglalink"
                ]
            ]
        ];
        $saveData = new ProductDeepLink();
        $insert_item = array();
        $result = $this->firebaseDeepLinkService->post($body);
        if ($result['status_code'] == 200) {
            $shortLink = $result['response']['shortLink'];
            $request['deep_link'] = $shortLink;
            $request['full_link'] = $fullLink;
            $result = $this->agentDeepLinkRepository->save($request);
            if ($result) {
                return new Response("Agent DeepLink has been successfully created");
            }
        } else {
            return new Response("Something is wrong");
        }

    }

    /**
     * @param $agentId
     * @return mixed
     */
    public function getDeepLinkListByAgentId($agentId)
    {
        return $this->agentDeepLinkRepository->findDeeplinkById($agentId);
    }

    /**
     * @param $agentDeepLinkId
     * @return Response
     */
    public function agentDeeplinkDeleteById($agentDeepLinkId)
    {
        return $this->agentDeepLinkRepository->agentDeeplinkSoftDelete($agentDeepLinkId);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function agentDeeplinkReportData($request)
    {
        $data = $this->agentDeepLinkRepository->findAll()->where('is_delete', 0);
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('agent_info', function ($data) {
                return $data->agentInfo->name . ' - ' . $data->agentInfo->msisdn;
            })
            ->addColumn('tview', function ($data) {
                return $data->total_buy + $data->total_cancel + $data->buy_attempt;
            })->addColumn('tview', function ($data) {
                return $data->total_buy + $data->total_cancel + $data->buy_attempt;
            })
            ->addColumn('action', function ($row) {
                $url = route('agent.deeplink.report.details', $row->id);
                $actionBtn = '<a href="' . $url . '" class="edit btn btn-success btn-sm">view</a>';
//                $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function agentDeeplinkReportFilterData($request)
    {
        $data = $this->agentDeepLinkRepository->findAll()->where('is_delete', 0);
        $searchByFromdate = ($request->has('searchByFromdate')) ? $request->input('searchByFromdate') : null;
        $searchByTodate = ($request->has('searchByTodate')) ? $request->input('searchByTodate') : null;
        $detailsData = $this->agentDeepLinkDetailsRepository->getCountsByActionType(
            $searchByFromdate,
            $searchByTodate
        );
        $from = is_null($searchByFromdate) ? Carbon::now()->subMonths(1)->toDateString() . ' 00:00:00' : Carbon::createFromFormat('Y-m-d H:i:s', $searchByFromdate . ' 00:00:00')->toDateTimeString();
        $to = is_null($searchByTodate) ? Carbon::now()->toDateString() . ' 23:59:59' : Carbon::createFromFormat('Y-m-d H:i:s', $searchByTodate . '23:59:59')->toDateTimeString();
        $result = [];
        foreach ($data as $key => $log) {
            $result[$key]['id'] = $log->id;
            $result[$key]['agent_info'] = $log->agentInfo->name . ' - ' . $log->agentInfo->msisdn;
            $result[$key]['deep_link'] = $log->deep_link;
            $result[$key]['deeplink_type'] = $log->deeplink_type;

            $detailsDatum = $detailsData
                ->where('agent_deeplink_id', $log->id)
                ->flatten()
                ->toArray();
            $result[$key]['log'] = $this->prepareFilteredCount($detailsDatum);
        }

        return Datatables::collection($result)
            ->addIndexColumn()
            ->addColumn('tview', function ($result) {
                return $result['log']['total_buy'] + $result['log']['total_buy_attempt'] + $result['log']['total_cancel'];
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
                $url = route('agent.deeplink.report.details', $result['id']);
                $actionBtn = '<a href="' . $url . '?from=' . $from . '&to=' . $to . '" class="edit btn btn-success btn-sm">view</a>';
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
     * @param $id
     * @param $request
     * @return mixed
     */
    public function agentDeeplinkDetailReportData($id, $request)
    {
        if (!empty($request->input('from')) && !empty($request->input('to'))) {
            $from = Carbon::createFromFormat('Y-m-d H:i:s', $request->input('from') . '00:00:00')->toDateTimeString();
            $to = Carbon::createFromFormat('Y-m-d H:i:s', $request->input('to') . '23:59:59')->toDateTimeString();
            $data = AgentDeeplinkDetail::where('agent_deeplink_id', $id)->whereBetween('created_at', [$from, $to])->get();
        } else {
            $data = $this->agentDeepLinkDetailsRepository->findAll()->where('agent_deeplink_id', $id);
        }

        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('date', function ($data) {
                return date('d-m-Y', strtotime($data->created_at));
            })
            ->rawColumns(['date'])
            ->make(true);
    }


}

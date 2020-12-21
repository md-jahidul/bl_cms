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
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Support\Facades\Crypt;
use DataTables;

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
     */
    public function __construct(
        AgentRepository $agentRepository,
        AgentDeepLinkRepository $agentDeepLinkRepository,
        FirebaseDeepLinkService $firebaseDeepLinkService
    )
    {
        $this->agentRepository = $agentRepository;
        $this->agentDeepLinkRepository = $agentDeepLinkRepository;
        $this->firebaseDeepLinkService = $firebaseDeepLinkService;
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
            $product_code = $request['product_code'];
            $checkProduct = MyBlProduct::where('product_code', $product_code)->first();
            if (!$checkProduct) {
                throw new NotFoundHttpException();
            }
        }
        $body = [
            "dynamicLinkInfo" => [
                "domainUriPrefix" => env('DOMAINURIPREFIX'),
                "link" => "https://banglalink.net/agent/$productType/$product_code",
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
            $result = $this->agentDeepLinkRepository->save($request);
            if ($result) {
                return new Response("Agent DeepLink has been successfully created");
            }
        } else {
            return new Response("Something is wrong");
        }

    }

    public function getDeepLinkListByAgentId($agentId)
    {
        return $this->agentDeepLinkRepository->findDeeplinkById($agentId);
    }

    public function agentDeeplinkDeleteById($agentDeepLinkId)
    {
        return $this->agentDeepLinkRepository->agentDeeplinkSoftDelete($agentDeepLinkId);
    }

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
            })
            ->addColumn('action', function ($row) {
                $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">view</a>';
//                $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

}

<?php

namespace App\Services;

use App\Repositories\PgwGatewayRepository ;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redis;
use DB;

class PgwGatewayService
{
    use CrudTrait;


    /**
     * @var pgwGatewayRepository
     */
    protected $pgwGatewayRepository;


    /**
     * SettingService constructor.
     * @param PgwGatewayRepository $settingRepository
     */
    public function __construct(PgwGatewayRepository $pgwGatewayRepository)
    {
        $this->pgwGatewayRepository = $pgwGatewayRepository;
        $this->setActionRepository($pgwGatewayRepository);
    }

    /**
     * Storing the banner resource
     * @return Response
     */
    public function storePgwGateway($request)
    { 
        try {
            $data['gateway_id'] =  $request['gateway_id'];
            $data['gateway_name'] =  ($request['gateway_id'] == 201) ? 'bKash' : 'Visa/Master';
            $data['type'] =  ($request['gateway_id'] == 201) ? 'Mobile' : 'Card';
            $data['status'] =  $request['status'] ?? 0;
            $data['currency'] =  $request['currency'];
            $data['logo_web'] =  $request['logo_web'];
            $data['logo_mobile'] =  $request['logo_mobile'];
            $this->save($data);
            return new Response("PGW gateway has been successfully created");
        } catch (\Exception $e) {
            return response()->json([
                'status' => ' FAILED',
                'message' => $e->getMessage()
            ], 500);
        } 
    }

    /**
     * Updating the banner
     * @param $data
     * @return Response
     */
    public function updatePgwGateway($request, $id)
    {
        try {
            $data['gateway_id'] =  $request['gateway_id'];
            $data['gateway_name'] =  ($request['gateway_id'] == 201) ? 'bKash' : 'Visa/Master';
            $data['type'] =  ($request['gateway_id'] == 201) ? 'Mobile' : 'Card';
            $data['status'] =  $request['status'] ?? 0;
            $data['currency'] =  $request['currency'];
            $data['logo_web'] =  $request['logo_web'];
            $data['logo_mobile'] =  $request['logo_mobile'];
            $pgw = $this->findOne($id);
            $pgw->update($data);
            // Delete Redis Data
            Redis::del('PaymentGatewayList');

            return new Response("PGW gateway has been successfully updated");
        } catch (\Exception $e) {
            return response()->json([
                'status' => ' FAILED',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function destroyPgwGateway($id)
    {
        $setting = $this->findOne($id);
        $setting->delete();
        return Response('PGW gateway has been successfully deleted');
    }
}

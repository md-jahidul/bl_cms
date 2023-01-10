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
     * PgwGatewayService constructor.
     * @param PgwGatewayRepository $PgwGatewayRepository
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
            $data['type'] =  $request['type'];
            $data['status'] =  $request['status'];
            $data['currency'] =  $request['currency'];
            $data['logo_web'] =  $request['logo_web'];
            $data['logo_mobile'] =  $request['logo_mobile'];
            $this->save($data);
            // Delete Redis Data
            Redis::connection('secondary_redis')->del('PaymentGatewayList');
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
    { //dd($request['status']);
        try {
            $data['gateway_id'] =  $request['gateway_id'];
            $data['gateway_name'] =  ($request['gateway_id'] == 201) ? 'bKash' : 'Visa/Master';
            $data['type'] =  $request['type'];
            $data['status'] =  $request['status'];
            $data['currency'] =  $request['currency'];
            $data['logo_web'] =  $request['logo_web'];
            $data['logo_mobile'] =  $request['logo_mobile'];
            $pgw = $this->findOne($id);
            $pgw->update($data);
            // Delete Redis Data
            Redis::connection('secondary_redis')->del('PaymentGatewayList');

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
        $pgw = $this->findOne($id);
        $pgw->delete();
        // Delete Redis Data
        Redis::connection('secondary_redis')->del('PaymentGatewayList');
        return Response('PGW gateway has been successfully deleted');
    }
}

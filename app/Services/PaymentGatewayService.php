<?php

namespace App\Services;

use App\Repositories\PaymentGatewayRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redis;

class PaymentGatewayService
{
    use CrudTrait;
    private $paymentGatewayRepository;

    public function __construct(PaymentGatewayRepository $paymentGatewayRepository)
    {
        $this->paymentGatewayRepository = $paymentGatewayRepository;
        $this->setActionRepository($this->paymentGatewayRepository);
    }

    public function save($request)
    {
        try {
            $data['gateway_id'] =  $request['gateway_id'];
            $data['display_order'] = $this->paymentGatewayRepository->findAll()->count() + 1;
            $data['gateway_name'] = null;
            if ($data['gateway_id'] == 101) {
                $data['gateway_name'] = 'Visa/Master';
            } else if ($data['gateway_id'] == 201) {
                $data['gateway_name'] = 'bKash';
            } else {
                $data['gateway_name'] = 'ssl';
            }
            $data['type'] =  $request['type'];
            $data['status'] =  $request['status'];
            $data['currency'] =  $request['currency'];
            if (!empty($request['logo_web'])) {
                $data['logo_web'] = 'storage/' . $request['logo_web']->store('payment-gateways');
            }
            if (!empty($request['logo_mobile'])) {
                $data['logo_mobile'] = 'storage/' . $request['logo_mobile']->store('payment-gateways');
            }

            $this->paymentGatewayRepository->save($data);

            Redis::del('PaymentGatewayListV2');
            return new Response("Payment gateway has been successfully created");
        } catch (\Exception $e) {
            return response()->json([
                'status' => ' FAILED',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function findOne($id, $relation = null)
    {
        return $this->paymentGatewayRepository->findOne($id);
    }

    public function update($request, $id)
    {
        try {
            $data['gateway_id'] =  $request['gateway_id'];
            $data['gateway_name'] = null;
            if ($data['gateway_id'] == 101) {
                $data['gateway_name'] = 'Visa/Master';
            } else if ($data['gateway_id'] == 201) {
                $data['gateway_name'] = 'bKash';
            } else {
                $data['gateway_name'] = 'ssl';
            }
            $data['type'] =  $request['type'];
            $data['status'] =  $request['status'];
            $data['currency'] =  $request['currency'];
            if (isset($request['logo_web'])) {
                $data['logo_web'] = 'storage/' . $request['logo_web']->store('gateways');
            }
            if (isset($request['logo_mobile'])) {
                $data['logo_mobile'] = 'storage/' . $request['logo_mobile']->store('gateways');
            }
            $pgw = $this->paymentGatewayRepository->findOne($id);
            $pgw->update($data);
            // Delete Redis Data
            Redis::del('PaymentGatewayListV2');

            return new Response("Payment Gateway has been successfully updated");
        } catch (\Exception $e) {
            return response()->json([
                'status' => ' FAILED',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function delete($id)
    {
        Redis::del('PaymentGatewayListV2');
        return $this->paymentGatewayRepository->destroy($id);
    }

    public function tableSort($data)
    {
        $this->paymentGatewayRepository->manageTableSort($data);
        Redis::del('PaymentGatewayListV2');
        return new Response('Sorted successfully');
    }
}

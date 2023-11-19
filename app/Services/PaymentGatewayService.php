<?php

namespace App\Services;

use App\Helpers\Helper;
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
        $data = Helper::versionCode($request['android_version_code'], $request['ios_version_code']);

        try {
            $data['gateway_id'] =  $request['gateway_id'];
            $data['display_order'] = $this->paymentGatewayRepository->findAll()->count() + 1;
            $data['gateway_name'] = null;
            if ($data['gateway_id'] == 101) {
                $data['gateway_name'] = 'Visa/Master';
                $data['type'] = 'card';
            } else if ($data['gateway_id'] == 201 || $data['gateway_id'] == 211) {
                $data['gateway_name'] = 'bKash';
                $data['type'] = 'mfs';
            } else if($data['gateway_id'] == 601) {
                $data['gateway_name'] = 'port-wallet';
                $data['type'] = 'port-wallet';
            } else {
                $data['gateway_name'] = 'ssl';
                $data['type'] =  'ssl';
            }

            $data['status'] =  $request['status'];
            $data['currency'] =  $request['currency'];
            if (!empty($request['logo_web'])) {
                $data['logo_web'] = 'storage/' . $request['logo_web']->store('payment-gateways');
            }
            if (!empty($request['logo_mobile'])) {
                $data['logo_mobile'] = 'storage/' . $request['logo_mobile']->store('payment-gateways');
            }

            if (!empty($request['logo_mobile_v2'])) {
                $data['logo_mobile_v2'] = 'storage/' . $request['logo_mobile_v2']->store('payment-gateways');
            }

            $this->paymentGatewayRepository->save($data);

            Redis::del('PaymentGatewayListV2');
            Redis::del('PaymentGatewayListV3');
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
        $component =  $this->paymentGatewayRepository->findOne($id);
        $android_version_code = implode('-', [$component['android_version_code_min'], $component['android_version_code_max']]);
        $ios_version_code = implode('-', [$component['ios_version_code_min'], $component['ios_version_code_max']]);
        $component->android_version_code = $android_version_code;
        $component->ios_version_code = $ios_version_code;

        return $component;
    }

    public function update($request, $id)
    {
        $data = Helper::versionCode($request['android_version_code'], $request['ios_version_code']);

        try {
            $data['gateway_id'] =  $request['gateway_id'];
            $data['gateway_name'] = null;
            if ($data['gateway_id'] == 101) {
                $data['gateway_name'] = 'Visa/Master';
            } else if ($data['gateway_id'] == 201 || $data['gateway_id'] == 211) {
                $data['gateway_name'] = 'bKash';
            } else if($data['gateway_id'] == 601) {
                $data['gateway_name'] = 'port-wallet';
                $data['type'] = 'port-wallet';
            } else {
                $data['gateway_name'] = 'ssl';
            }
            $data['status'] =  $request['status'];
            $data['currency'] =  $request['currency'];
            if (isset($request['logo_web'])) {
                $data['logo_web'] = 'storage/' . $request['logo_web']->store('gateways');
            }
            if (isset($request['logo_mobile'])) {
                $data['logo_mobile'] = 'storage/' . $request['logo_mobile']->store('gateways');
            }
            if (isset($request['logo_mobile_v2'])) {
                $data['logo_mobile_v2'] = 'storage/' . $request['logo_mobile_v2']->store('gateways');
            }

            $pgw = $this->paymentGatewayRepository->findOne($id);
            $pgw->update($data);
            // Delete Redis Data
            Redis::del('PaymentGatewayListV2');
            Redis::del('PaymentGatewayListV3');

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
        Redis::del('PaymentGatewayListV3');
        return $this->paymentGatewayRepository->destroy($id);
    }

    public function tableSort($data)
    {
        $this->paymentGatewayRepository->manageTableSort($data);
        Redis::del('PaymentGatewayListV2');
        Redis::del('PaymentGatewayListV3');
        return new Response('Sorted successfully');
    }
}

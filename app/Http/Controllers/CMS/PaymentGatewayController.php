<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\NewCampaignModality\MyBlCampaignSection;
use App\Models\PaymentGateway;
use App\Services\PaymentGatewayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class PaymentGatewayController extends Controller
{
    public $paymentGatewayService;
    public function __construct(PaymentGatewayService $paymentGatewayService) {
        $this->paymentGatewayService = $paymentGatewayService;
    }
    public function index()
    {
        $orderBy = ['column' => 'display_order', 'direction' => 'ASC'];
        $paymentGateways = $this->paymentGatewayService->findAll(null, null,  $orderBy);

        return view('admin.payment-gateways.index', compact('paymentGateways'));
    }

    public function create()
    {
        return view('admin.payment-gateways.create');
    }

    public function store(Request $request)
    {
        if ($this->paymentGatewayService->save($request->all())) {
            Session::flash('message', 'Payment Gateway store successful');
        }
        else{
            Session::flash('danger', 'Payment Gateway Stored Failed');
        }

        return redirect('payment-gateways');
    }

    public function edit($id)
    {
        $pgwGateways_info = $this->paymentGatewayService->findOne($id);

        return view('admin.payment-gateways.edit', compact('pgwGateways_info'));
    }

    public function update(Request $request,  $id)
    {
        if ($this->paymentGatewayService->update($request->all(), $id)) {
            Session::flash('message', 'Payment Gateway Update successful');
        }
        else{
            Session::flash('danger', 'Payment Gateway Update Failed');
        }

        return redirect('payment-gateways');
    }


    public function destroy($myBlCampaignSectionId)
    {
        $this->paymentGatewayService->delete($myBlCampaignSectionId);
        return redirect('payment-gateways');
    }

    public function categorySortable(Request $request)
    {
        return $this->paymentGatewayService->tableSort($request);
    }
}

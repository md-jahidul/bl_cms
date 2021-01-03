<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\PushNotificationProductPurchaseService;
use Illuminate\Support\Facades\Auth;

class PushNotificationProductPurchaseController extends Controller
{
    /**
     * @var bool
     */
    private $isAuthenticated = true;
    /**
     * @var PushNotificationProductPurchaseService
     */
    protected $pushNotificationProductPurchase;

    /**
     * PushNotificationProductPurchaseController constructor.
     * @param PushNotificationProductPurchaseService $pushNotificationProductPurchase
     */
    public function __construct(PushNotificationProductPurchaseService $pushNotificationProductPurchase)
    {
        $this->pushNotificationProductPurchase=$pushNotificationProductPurchase;
        $this->middleware('auth');

    }

    public function index(Request $request){
        if($request->ajax()){
           return $this->pushNotificationProductPurchase->getPurchaseList();
        }
        return view('admin.notification.notification-product-purchase.index');

    }
}

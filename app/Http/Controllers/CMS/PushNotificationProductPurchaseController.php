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
        $this->pushNotificationProductPurchase = $pushNotificationProductPurchase;
        $this->middleware('auth');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            if ($request->has('searchByFromdate') || $request->has('searchByTodate')) {
                return $this->pushNotificationProductPurchase->getPurchaseFilteredList($request);
            } else {
                return $this->pushNotificationProductPurchase->getPurchaseList($request);
            }
        }
        return view('admin.notification.notification-product-purchase.index');

    }

    /**
     * @param null $id
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details($id = null, Request $request)
    {
        $from = (!empty($request->input('from'))) ? $request->input('from') : null;
        $to = (!empty($request->input('to'))) ? $request->input('to') : null;
        if ($request->ajax()) {
            return $this->pushNotificationProductPurchase->getPurchaseDetailsList($id, $from, $to);
        }
        return view('admin.notification.notification-product-purchase.details', compact('id', 'from', 'to'));

    }


}

<?php

namespace App\Http\Controllers\Auth;

use App\Models\AgentList;
use App\Models\AgentDeeplinkDetail;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AgentRequest;
use App\Http\Requests\AgentDeeplinkRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Redirect;
use App\Services\AgentService;
use Mail;

class NewCMSAuthController extends Controller
{
    /**
     * @var AgentService
     */
//    protected $agentService;

//    /**
//     * AgentListController constructor.
//     * @param AgentService $agentService
//     */
//    public function __construct(AgentService $agentService)
//    {
//        $this->agentService = $agentService;
//        $this->middleware('auth');
//    }


    public function verifyToken()
    {
        $token = Redis::get("user_token_" . auth()->id() . ":");

        $verifyTokenUrl = "/api/v1/access-token";
        $refreshTokenUrl = "/api/v1/refresh";
        $baseUrl = env("NEW_CMS_URL", "http://172.16.191.50:8443");

        $response = $this->cUrlRequest($verifyTokenUrl, $token);

        if ($response['status_code'] == 200){
            $redirectUrl = $baseUrl . "/welcome-new?access_token=" . $response['data']['access_token'] . "&source=" . $baseUrl;
            return [
                'access_token' => $response['data']['access_token'],
                'redirect_url' => $redirectUrl
            ];
        }

//        dd($token);
//        $response = $this->cUrlRequest($refreshTokenUrl, $token);
////        dd($response);
//        $redirectUrl = $baseUrl . "/welcome-new?access_token=" . $response['access_token'] . "&source=" . $baseUrl;
//        return [
//            'access_token' => $response['access_token'],
//            'redirect_url' => $redirectUrl
//        ];
    }

//    public function storeAccessTokenForNewCMS($request)
//    {
//        $urlEndPoint = "/api/v1/login";
//        $response = $this->cUrlRequest($request->all(), $urlEndPoint);
//        $user = User::where('email', $request->email)->first();
//        if ($response && $user) {
//            $redisKey = "user_token_" . $user->id . ":";
//            Redis::set($redisKey, $response['access_token']);
//        }
//    }

    public function cUrlRequest($urlEndPoint, $token)
    {
        $headers = [
            "Authorization: Bearer " . $token
        ];
        $baseUrl = env("NEW_CMS_URL", "http://172.16.191.50:8443");
        $url = $baseUrl . $urlEndPoint;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper("POST"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        $result = json_decode($result, true);

        if ($httpCode == 200){
            return $result;
        }
        Log::error('New CMS Login Error:' . $result['message']);
        return $result;
    }
}

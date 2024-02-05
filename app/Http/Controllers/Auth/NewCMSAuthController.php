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
        $newCmsUrl = env("NEW_CMS_URL", "http://172.16.191.50:8445");
        $newCmsApi = env("NEW_CMS_API", "http://172.16.191.50:8443");
        $url = $newCmsApi . $verifyTokenUrl;
        $response = $this->cUrlRequest($url, $token);

        if ($response['status_code'] == 200){
            return [
                "status" => "SUCCESS",
                "status_code" => 200,
                "message" => "Token is Valid",
                "data" => [
                    'status_code' => $response['status_code'],
                    'access_token' => $response['data']['access_token'],
                    'redirect_url' => $newCmsUrl
                ]
            ];
        }
        return $response;
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

    public function cUrlRequest($url, $token)
    {
        $headers = [
            "Authorization: Bearer " . $token
        ];
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

        Log::error('New CMS Login Error:' . json_encode($result));
        return $result;
    }
}

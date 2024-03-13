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
    protected const DXP_TOKEN_PREFIX = "dxp_user_token:";

    public function verifyToken()
    {
        $token = Redis::get(self::DXP_TOKEN_PREFIX . auth()->id());

        $verifyTokenUrl = "/api/v1/access-token";
        $refreshTokenUrl = "/api/v1/refresh";

        $dxpUrl = config("misc.migrator.dxp.fe_base_url");;
        $dxpApi = config("misc.migrator.dxp.api_base_url");;

        $url = $dxpApi . $verifyTokenUrl;
        $response = $this->cUrlRequest($url, $token);

        if ($response['status_code'] == 200){
            return [
                "status" => "SUCCESS",
                "status_code" => 200,
                "message" => "Token is Valid",
                "data" => [
                    'status_code' => $response['status_code'],
                    'access_token' => $response['data']['access_token'],
                    'redirect_url' => $dxpUrl
                ]
            ];
        }
        return $response;
    }

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

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use http\Client;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use AuthenticatesUsers;

    protected const DXP_TOKEN_PREFIX = "dxp_user_token:";

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
//    protected $redirectTo = '/home';

//    protected $decayMinutes = 5;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $user = User::where('email', $request->email)->first();
            if ($user) {
                $user->update([
                    'status' => "locked"
                ]);
            }
            return redirect('/login')->with('error', 'Your account is locked. contact system Administrator');
        }

        if (config("misc.migrator.dxp_new_login")){
            $this->storeAccessTokenForNewCMS($request);
        }

        if ($this->attemptLogin($request)) {
            if (Auth::user()->status == "locked") {
                $this->logout($request);
                return redirect('/login')->with('error', 'Your account is locked. contact system Administrator');
            } else {
                return $this->sendLoginResponse($request);
            }
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    public function decayMinutes()
    {
        return env("DECAY_MINUTES", 2);
    }

    protected function hasTooManyLoginAttempts(Request $request)
    {
        $maxAttempts = env("LOGIN_ATTEMPT", 3);
        $decayMinutes = 2;
        return $this->limiter()->tooManyAttempts(
            $this->throttleKey($request), $maxAttempts, $decayMinutes
        );
    }

    public function storeAccessTokenForNewCMS($request)
    {
        $urlEndPoint = "/api/v1/login";
        $response = $this->cUrlRequest($request->all(), $urlEndPoint);
        $user = User::where('email', $request->email)->first();
        if ($response && $user) {
            $redisKey = self::DXP_TOKEN_PREFIX . $user->id;
            Redis::set($redisKey, $response['access_token']);
        }
    }

    public function cUrlRequest($request, $urlEndPoint)
    {
        $headers = [
            'Content-Type' => 'application/json'
        ];

        $body = [
            "email" => $request['email'],
            "password" => $request['password']
        ];

        $baseUrl =  config("misc.migrator.dxp.api_base_url");

        $url = $baseUrl . $urlEndPoint;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper("POST"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        $result = json_decode($result, true);

        if ($httpCode == 200){
            return [
                'access_token' => $result['data']['access_token'] ?? null
            ];
        }

        Log::error('New CMS Login Error:' . json_encode($result));
    }
}

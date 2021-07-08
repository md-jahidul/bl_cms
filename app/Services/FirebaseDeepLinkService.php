<?php

namespace App\Services;
use App\Exceptions\BLServiceException;

class FirebaseDeepLinkService
{
    /**
     * Get Host from env file
     *
     * @return string
     */
    public static function getHost()
    {
        return env('FIREBASE_HOST');
    }

    /**
     * Get Token from env file
     *
     * @return string
     */
    public static function getApiToken()
    {
        return env('FIREBASE_API_key');
    }

    /**
     * Get Host from env file
     *
     * @return string
     */
    public static function getPort()
    {

        return env('DOMAINURIPREFIX');
    }


    /**
     * Make the header array with authentication.
     *
     * @return array
     */
    private static function makeHeader()
    {
        return [
            'Content-Type: application/json',
            'Expect: 100-continue',
            'Authorization: Bearer AIzaSyC2yh-bvbrSpZry4TMJYVXrPl3K7_58-go'
        ];
    }

    /**
     * Make CURL request for POST request.
     *
     * @param  string  $url
     * @param  array   $body
     * @param  array   $headers
     * @return string
     */
    public static function post($body = [], $headers = null)
    {
        return static::makeMethod('post',$body, $headers);
    }

    /**
     * Make CURL request for GET request.
     *
     * @param string $url
     * @param array $body
     * @param array $headers
     * @return string
     */
    public static function get(array $body = [], $headers = null)
    {
        return static::makeMethod('get', $body, $headers);
    }


    /**
     * Make CURL request for a HTTP request.
     *
     * @param  string  $method
     * @param  string  $url
     * @param  array   $body
     * @param  array   $headers
     * @return string
     */
    private static function makeMethod($method,$body = [], $headers = null,$skip_service_exception = false)
    {
        $ch = curl_init();
        $headers = $headers ?: static::makeHeader();
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($method));
        static::makeRequest($ch,$body, $headers);
        $result = curl_exec($ch);
        $curl_info = curl_getinfo($ch);

        dd($result);
        if ($result != '' && !$result) {
            throw new BLServiceException($result);
        }
        $httpCode = $curl_info['http_code'];

        if ($httpCode >= 500 && !$skip_service_exception) {
            throw new BLServiceException($result);
        }

        return ['response' => json_decode($result,true), 'status_code' => $httpCode];
    }


    /**
     * Make CURL object for HTTP request verbs.
     *
     * @param  curl_init() $ch
     * @param  string  $url
     * @param  array   $body
     * @param  array   $headers
     * @return string
     */
    private static function makeRequest($ch,$body, $headers)
    {

        $url = static::getHost() /*. static::getApiToken()*/;
//        dd($url);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
    }




}


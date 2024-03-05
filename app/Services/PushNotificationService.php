<?php

namespace App\Services;

/**
 * Class PushNotificationService
 * @package App\Services
 */
class PushNotificationService
{
    /**
     * Get Host from env file
     *
     * @return string
     */
    public static function getHost()
    {
        return env('NOTIFICATION_HOST');
    }

    /**
     * Get Token from env file
     *
     * @return string
     */
    public static function getToken()
    {
        return env('NOTIFICATION_TOKEN');
    }


    public static function sendNotification($data, $notifcationDraftId = null)
    {
        $url = !$notifcationDraftId ? '/api/v1/push/notification' : '/api/v1/push/notification/' . $notifcationDraftId;

        $res = static::post($url, $data);

        return $res;
    }

    public static function sendPersistentNotification($data)
    {
        $res = static::post('/api/v1/push/persistent-notification', $data);

        return $res;
    }

    /**
     * Make the header array with authentication.
     *
     * @return array
     */
    private static function makeHeader()
    {
        return [
            //'X-Client-Token: '.static::getToken(),
            'Content-Type: application/json',
            'app-key: ' . static::getToken(),
            'Expect: 100-continue'
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
    public static function post($url, $body = [], $headers = null)
    {
        return static::makeMethod('post', $url, $body, $headers);
    }

    /**
     * Make CURL request for PUT request.
     *
     * @param  string  $url
     * @param  array   $body
     * @param  array   $headers
     * @return string
     */
    public static function put($url, $body = [], $headers = [])
    {
        return static::makeMethod('put', $url, $body, $headers);
    }

    /**
     * Make CURL request for DELETE request.
     *
     * @param  string  $url
     * @param  array   $body
     * @param  array   $headers
     * @return string
     */
    public static function delete($url, $body = [], $headers = [])
    {
        return static::makeMethod('delete', $url, $body, $headers);
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
    private static function makeMethod($method, $url, $body = [], $headers = null)
    {
        $ch = curl_init();
        $headers = $headers ?: static::makeHeader();
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($method));
        static::makeRequest($ch, $url, $body, $headers);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
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
    private static function makeRequest($ch, $url, $body, $headers)
    {
        $url = static::getHost() . $url;

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
    }
}

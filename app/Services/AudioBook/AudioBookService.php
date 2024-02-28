<?php

namespace App\Services\AudioBook;

use App\Exceptions\CurlRequestException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;


class AudioBookService
{
    protected $connectTimeout = 10;
    protected $requestTimeout = 30;
    protected const REDIS_KEY = "audio-book-data";
    protected const REDIS_TTL = 60 * 60 * 6;
    protected const AUDIO_BOOK_CONTENT_URL = 'v4/dynamic/mybl/get-popular-audiobook';

    public function getContents() {
        try {
            $response = $this->get(self::AUDIO_BOOK_CONTENT_URL, [] );
            Log::info($response);
                
            if(!$response) {
                throw new \Exception('Something went wrongd');
            }

            if ($response['status_code'] == "200") {
                $body = $response['response'];
                $responseData = json_decode($body);
                Redis::setex(self::REDIS_KEY, self::REDIS_TTL, json_encode($responseData));
            } else {
                Log::info('service unavailable');
                throw new \Exception('Something went wrongd');
            }
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    /**
     * Return  API Host
     *
     * @return mixed
     */
    protected function getHost()
    {
        return config('partners.audio-book.base_uri');
    }

    protected function get($url, $body = [], $headers = null, $skip_service_exception = false)
    {
        return $this->makeMethod('get', $url, $body, $headers, $skip_service_exception);
    }

    protected function makeMethod(
        $method,
        $url,
        $body = [],
        $headers = null,
        $skip_service_exception = false
    ) {
            $ch = curl_init();
            $headers = $headers ?: $this->makeHeader();
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($method));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this->connectTimeout);
            curl_setopt($ch, CURLOPT_TIMEOUT, $this->requestTimeout);
            static::makeRequest($ch, $url, $body, $headers);
            $result = curl_exec($ch);

            $curl_info = curl_getinfo($ch);

            if ($result != '' && !$result) {
                throw new CurlRequestException(curl_getinfo($ch));
            }
            $httpCode = $curl_info['http_code'];

        return ['response' => $result, 'status_code' => $httpCode];
    }

    /**
     * Make CURL object for HTTP request verbs.
     *
     * @param  curl_init() $ch
     * @param  string  $url
     * @param  array  $body
     * @param  array  $headers
     * @return string
     */
    protected function makeRequest($ch, $url, $body, $headers)
    {
        $url = $this->getHost() . $url;

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
    }

    protected function makeHeader()
    {
        $header = [];

        return $header;
    }
}

<?php

namespace App\Services;

use GuzzleHttp\Exception\GuzzleException;

class ApiService
{
    public $client;

    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client();
    }

    public function get($url)
    {
        try {
            return $this->client->get($url);
        } catch (GuzzleException $e) {
            return $e->getMessage();
        }
    }

    public function post($url, $data)
    {
        try {
            return $this->client->post($url, ['form_params' => $data]);
        } catch (GuzzleException $e) {
            return $e->getMessage();
        }
    }

    public function put($url, $data)
    {
        try {
            return $this->client->put($url, ['form_params' => $data]);
        } catch (GuzzleException $e) {
            return $e->getMessage();
        }
    }

    public function delete($url)
    {
        try {
            return $this->client->delete($url);
        } catch (GuzzleException $e) {
            return $e->getMessage();
        }
    }

}

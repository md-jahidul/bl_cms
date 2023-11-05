<?php

namespace App\Traits;

use Illuminate\Support\Facades\Redis;

trait RedisTrait
{
    public function redisGet($key)
    {
        try {
            return Redis::get($key);
        } catch (\Exception $e) {
            // Handle the Redis exception here (e.g., log or rethrow)
            return null;
        }
    }

    public function redisSet($key, $value, $expiration = null)
    {
        try {
            if ($expiration) {
                Redis::setex($key, $expiration, $value);
            } else {
                Redis::set($key, $value);
            }
        } catch (\Exception $e) {
            // Handle the Redis exception here (e.g., log or rethrow)
        }
    }

    public function redisHGet($hash, $field)
    {
        try {
            return Redis::hget($hash, $field);
        } catch (\Exception $e) {
            // Handle the Redis exception here (e.g., log or rethrow)
            return null;
        }
    }

    public function redisHSet($hash, $field, $value)
    {
        try {
            Redis::hset($hash, $field, $value);
        } catch (\Exception $e) {
            // Handle the Redis exception here (e.g., log or rethrow)
        }
    }

    public function redisDel($key)
    {
        try {
            return Redis::del($key);
        } catch (\Exception $e) {
            $this->handleRedisException($e);
        }
    }
    public function deleteRedisKeys(array $keys)
    {
        try {
            $deletedCount = 0;
            foreach ($keys as $key) {
                $deletedCount += Redis::del($key);
            }
            return $deletedCount;
        } catch (\Exception $e) {
            $this->handleRedisException($e);
        }
    }

    // You can add more methods for other Redis data structures like lists, sets, etc.

    // Handle Redis exceptions in a central place

    protected function handleRedisException(\Exception $e)
    {
        // Handle the Redis exception here (e.g., log or rethrow)
    }
}

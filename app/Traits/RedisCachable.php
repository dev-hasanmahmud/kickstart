<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;

trait RedisCachable
{
    public function redisSet(string $key, mixed $value, $expiration = null): void
    {
        if (is_null($expiration)) {
            Cache::store('redis')->forever($key, $value);
        } else {
            Cache::store('redis')->put($key, $value, $expiration);
        }
    }

    public function redisGet(string $key, mixed $default = null): mixed
    {
        return Cache::store('redis')->get($key, $default);
    }

    public function redisRemember(string $key, \Closure $callback, $expiration = null): mixed
    {
        if (is_null($expiration)) {
            return $this->redisRememberForever($key, $callback);
        }

        return Cache::store('redis')->remember($key, $expiration, $callback);
    }

    public function redisRememberForever(string $key, \Closure $callback): mixed
    {
        return Cache::store('redis')->rememberForever($key, $callback);
    }

    public function redisForget(string $key): void
    {
        Cache::store('redis')->forget($key);
    }

    public function redisHas(string $key): bool
    {
        return Cache::store('redis')->has($key);
    }
}

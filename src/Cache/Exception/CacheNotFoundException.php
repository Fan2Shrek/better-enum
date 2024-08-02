<?php

namespace Fan2Shrek\BetterEnum\Cache\Exception;

class CacheNotFoundException extends \Exception
{
    public function __construct(string $key, int $code = 0, \Throwable $previous = null)
    {
        parent::__construct("Cache with key $key not found", $code, $previous);
    }
}

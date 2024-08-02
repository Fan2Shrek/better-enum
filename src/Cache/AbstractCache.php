<?php

namespace Fan2Shrek\BetterEnum\Cache;

use Fan2Shrek\BetterEnum\Cache\CacheInterface;
use Fan2Shrek\BetterEnum\Cache\Exception\CacheNotFoundException;
use Fan2Shrek\BetterEnum\File\File;

abstract class AbstractCache implements CacheInterface
{
    /**
     * @var File[]
     */
    protected array $cache = [];

    public function load(string $key): bool
    {
        if ($this->has($key)) {
            return $this->doLoad($this->cache[$key]);
        }

        throw new CacheNotFoundException($key);
    }

    public function save(string $key, File $file): void
    {
        $this->cache[$key] = $this->doSave($key, $file);
    }

    public function has(string $key): bool
    {
        return isset($this->cache[$key]);
    }

    public function remove(string $key): void
    {
        $file = $this->cache[$key];

        $this->doRemove($file);

        unset($this->cache[$key]);
    }

    public function clear(): void
    {
        foreach (array_keys($this->cache) as $key) {
            $this->remove($key);
        }
    }

    abstract protected function doLoad(mixed $value): bool;

    abstract protected function doRemove(File $value): void;

    abstract protected function doSave(string $key, File $file): File;
}

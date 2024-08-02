<?php

namespace Fan2Shrek\BetterEnum\Cache;

use Fan2Shrek\BetterEnum\File\File;

interface CacheInterface {
    public function load(string $key): bool;

    public function save(string $key, File $value): void;

    public function has(string $key): bool;

    public function remove(string $key): void;

    public function clear(): void;
}

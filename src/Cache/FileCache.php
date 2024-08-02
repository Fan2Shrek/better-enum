<?php

namespace Fan2Shrek\BetterEnum\Cache;

use Fan2Shrek\BetterEnum\File\File;
use Symfony\Component\Filesystem\Filesystem;

class FileCache extends AbstractCache
{
    private Filesystem $fs;

    public function __construct(
        private string $cacheDir,
    ) {
        $this->fs = new Filesystem;
        if (!$this->fs->exists($this->cacheDir)) {
            $this->fs->mkdir($this->cacheDir);
        }
    }

    public function doRemove(File $file): void
    {
        $this->fs->remove($file->getPath());
    }

    public function doSave(string $key, File $file): File
    {
        $this->fs->dumpFile($this->getCacheDir() . $this->getInternalKey($key) . '.php', $file->getContent());

        return $file;
    }


    public function has(string $key): bool
    {
        return $this->fs->exists($this->getCacheDir() . $this->getInternalKey($key) . '.php') || parent::has($key);
    }

    public function load(string $key): bool
    {
        $key = $this->getInternalKey($key);
        $this->cache[$key] = $key . '.php';

        return parent::load($key);
    }

    protected function doLoad(mixed $value): bool
    {
        return include $this->getCacheDir() . $value;
    }

    private function getInternalKey(string $key): string
    {
        return sha1($key);
    }

    private function getCacheDir(): string
    {
        return $this->cacheDir . '/';
    }
}

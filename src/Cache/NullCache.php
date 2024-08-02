<?php

namespace Fan2Shrek\BetterEnum\Cache;

use Fan2Shrek\BetterEnum\File\File;

class NullCache extends AbstractCache
{
    public function doLoad(mixed $file): bool
    {
        try {
            eval('?>' . $file->getContent());

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function doRemove(File $file): void
    {
        // do nothing
    }

    public function doSave(string $key, File $file): File
    {
        return $file;
    }
}

<?php

namespace Fan2Shrek\BetterEnum\File;

class File {
    public function __construct(
        private string $path,
        private string $content,
    ) {
    }

    public function getPath(): string {
        return $this->path;
    }

    public function getContent(): string {
        return $this->content;
    }
}

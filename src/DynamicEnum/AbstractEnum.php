<?php

namespace Fan2Shrek\BetterEnum\DynamicEnum;

abstract class AbstractEnum {
    public function __construct(
        private string $name,
        private string $namespace = '',
        private array $interfaces = [],
        private array $traits = [],
    ) {
    }

    public function getNamespace(): string
    {
        return $this->namespace;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getInterfaces(): array
    {
        return $this->interfaces;
    }

    public function getTraits(): array
    {
        return $this->traits;
    }

    public function getFQCN(): string 
    {
        if ('' === $this->namespace) {
            return $this->name;
        }

        return $this->namespace . '\\' . $this->name;
    }
}

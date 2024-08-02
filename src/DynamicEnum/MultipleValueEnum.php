<?php

namespace Fan2Shrek\BetterEnum\DynamicEnum;

class MultipleValueEnum extends AbstractEnum
{
    public function __construct(
        string $name,
        string $namespace = '',
        private array $names = [],
    ) {
        parent::__construct($name, $namespace);
    }

    public function getNames(): array
    {
        return $this->names;
    }
}

<?php

namespace Fan2Shrek\BetterEnum\DynamicEnum\Model;

readonly class ValueHolder implements \IteratorAggregate
{
    public function __construct(
        public int $value,
        public array $enums,
    ) {
    }

    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->enums);
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }
}

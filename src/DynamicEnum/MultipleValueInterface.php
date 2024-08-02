<?php

namespace Fan2Shrek\BetterEnum\DynamicEnum;

use Fan2Shrek\BetterEnum\DynamicEnum\Model\ValueHolder;

interface MultipleValueInterface 
{
    public static function getValue(array $values): ValueHolder;

    public static function getEnums(int $value): ValueHolder;
}

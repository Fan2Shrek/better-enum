<?php

namespace Fan2Shrek\BetterEnum;

use Fan2Shrek\BetterEnum\DynamicEnum\Model\ValueHolder;

trait CalculatableTrait {
    public static function getValue(array $values): ValueHolder 
    {
        return ValueCalculator::getValue($values);
    }

    public static function getEnums(int $value): ValueHolder
    {
        return ValueCalculator::getEnums($value, static::cases());
    }
}

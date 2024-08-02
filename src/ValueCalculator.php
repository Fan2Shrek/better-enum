<?php

namespace Fan2Shrek\BetterEnum;

use Fan2Shrek\BetterEnum\DynamicEnum\Model\ValueHolder;

class ValueCalculator {
    public static function getValue(array $values): ValueHolder 
    {
        return new ValueHolder(array_reduce($values, fn($carry, $value) => $carry + $value->value, 0), $values);
    }

    public static function getEnums(int $value, array $cases): ValueHolder
    {
        $enum = [];

        $convertedCases = array_reduce($cases, function($carry, $case) {
            $carry[$case->value] = $case; 
            
            return $carry;
        }, []);

        foreach (self::resolve($value, count($cases)) as $bit) {
            $enum[] = $convertedCases[$bit];
        }

        return new ValueHolder($value, $enum);
    } 

    private static function resolve(int $value, int $bitLenght): array
    {
        $ones = [];
        $max = \PHP_INT_MAX;

        while (1 && $max !== 0 && 0 < $bitLenght) {
            --$bitLenght;
            $max = 1 << $bitLenght;

            if (($max ^ $value) < $value) {
                $ones[] = $max;
            }
        }

        return $ones;
    }
}

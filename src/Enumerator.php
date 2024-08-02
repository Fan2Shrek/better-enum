<?php

namespace Fan2Shrek\BetterEnum;

use Fan2Shrek\BetterEnum\Cache\CacheInterface;
use Fan2Shrek\BetterEnum\Cache\NullCache;
use Fan2Shrek\BetterEnum\DynamicEnum\DynamicEnumMetadata;
use Fan2Shrek\BetterEnum\DynamicEnum\MultipleValueEnum;
use Fan2Shrek\BetterEnum\DynamicEnum\CaseMetadata;
use Fan2Shrek\BetterEnum\DynamicEnum\MultipleValueInterface;

class Enumerator {
    private CacheInterface $cache;
    private DynamicEnumGeneratorInterface $dynamicEnumGenerator;
    private array $enums = [];

    public function __construct(
        ?CacheInterface $cache = null,        
    ) {
        $this->cache = $cache ?? new NullCache();   
    }

    protected function getDynamicClassGenerator(): DynamicEnumGeneratorInterface
    {
        return $this->dynamicEnumGenerator ?? $this->dynamicEnumGenerator = new DynamicEnumGenerator();
    }

    public function generateEnum(DynamicEnumMetadata $enumMetadata): void
    {
        if (!$this->cache->has($enumMetadata->getFQCN())) {
            $file = $this->getDynamicClassGenerator()->generateEnum($enumMetadata);
    
            $this->cache->save($enumMetadata->getFQCN(), $file);
        }
        
        $this->cache->load($enumMetadata->getFQCN());
    }

    public function createMultipleValueEnum(MultipleValueEnum $metadata): void
    {
        $innerEnum = new DynamicEnumMetadata(
            $metadata->getName(),
            'int',
            $metadata->getNamespace(),
            interfaces: [MultipleValueInterface::class],
            traits: [CalculatableTrait::class],
        );

        $i = 0;
        foreach ($metadata->getNames() as $value) {
            $innerEnum->addCase(new CaseMetadata($value, 1 << $i));
            $i++;
        }

        $this->generateEnum($innerEnum);
    }
}

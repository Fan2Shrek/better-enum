<?php

namespace Fan2Shrek\BetterEnum\DynamicEnum;

class DynamicEnumMetadata extends AbstractEnum {
    public function __construct(
        string $name, 
        private string $backedType,
        string $namespace = '', 
        private array $cases = [],
        array $interfaces = [],
        array $traits = [],
    ) {
        parent::__construct($name, $namespace, $interfaces, $traits);

        if (!in_array($backedType, ['int', 'string'])) {
            throw new \InvalidArgumentException('Invalid backed type');
        }
    }

    public function getBackedType(): string
    {
        return $this->backedType;
    }

    public function addCase(CaseMetadata $case): void
    {
        $this->cases[] = $case;
    }

    public function getCases(): array
    {
        return $this->cases;
    }
}

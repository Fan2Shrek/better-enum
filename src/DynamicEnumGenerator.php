<?php

namespace Fan2Shrek\BetterEnum;

use Fan2Shrek\BetterEnum\DynamicEnum\CaseMetadata;
use Fan2Shrek\BetterEnum\DynamicEnum\DynamicEnumMetadata;
use Fan2Shrek\BetterEnum\File\File;

class DynamicEnumGenerator implements DynamicEnumGeneratorInterface {
    public function generateEnum(DynamicEnumMetadata $enumMetadata): File
    {
        $content = strtr($this->getHeader(), [
            '{{ EnumName }}' => $enumMetadata->getName(),
            '{{ BackedType }}' => $enumMetadata->getBackedType(),
            '{{ Content }}' => $this->getContent($enumMetadata),
            '{{ Namespace }}' => '' === $enumMetadata->getNamespace() ? '' : \sprintf("\nnamespace %s;\n", $enumMetadata->getNamespace()),
            '{{ Interfaces }}' => [] === $enumMetadata->getInterfaces() ? '' : \sprintf(' implements %s', $this->formatInterfaces($enumMetadata->getInterfaces())),
        ]);

        return new File($enumMetadata->getName() . '.php', $content);
    }

    private function getContent(DynamicEnumMetadata $enumMetadata): string
    {
        $content = '';

        foreach ($enumMetadata->getTraits() as $trait) {
            $content .= sprintf("    use \\%s;\n", $trait);
        } 

        foreach ($enumMetadata->getCases() as $value) {
            if ('' !== $content) {
                $content .= "\n";
            }
            $content .= $this->doCase($value);
        }

        return $content;
    }

    private function doCase(CaseMetadata $caseMetada): string
    {
        return sprintf("    case %s = %s;", strtoupper($caseMetada->getName()), $caseMetada->getValue());
    }

    private function formatInterfaces(array $interfaces): string
    {
        $string = '';

        foreach ($interfaces as $interface) {
            $string .= '\\' . $interface;
        }

        return $string;
    }

    private function getHeader(): string
    {
        return <<<EOTXT
<?php
{{ Namespace }}
enum {{ EnumName }}: {{ BackedType }}{{ Interfaces }} {
{{ Content }}
}

EOTXT;
    }
}

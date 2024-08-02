<?php

namespace Fan2Shrek\BetterEnum;

use Fan2Shrek\BetterEnum\DynamicEnum\DynamicEnumMetadata;
use Fan2Shrek\BetterEnum\File\File;

interface DynamicEnumGeneratorInterface {
    public function generateEnum(DynamicEnumMetadata $enumMetadata): File;
}

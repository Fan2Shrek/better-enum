<?php

use Fan2Shrek\BetterEnum\Cache\FileCache;

require_once __DIR__ . '/vendor/autoload.php';

$enumerator = new Fan2Shrek\BetterEnum\Enumerator(new FileCache(__DIR__ . '/var/cache'));

$metadata = new Fan2Shrek\BetterEnum\DynamicEnum\DynamicEnumMetadata('TestEnum', 'int', 'App');

$metadata->addCase(new Fan2Shrek\BetterEnum\DynamicEnum\CaseMetadata('A', 1));
$metadata->addCase(new Fan2Shrek\BetterEnum\DynamicEnum\CaseMetadata('B', 2));
$metadata->addCase(new Fan2Shrek\BetterEnum\DynamicEnum\CaseMetadata('C', 3));

$enumerator->generateEnum($metadata);

$enumerator->createMultipleValueEnum(new Fan2Shrek\BetterEnum\DynamicEnum\MultipleValueEnum('LinuxPermissionEnum', 'App', ['EXECUTE', 'WRITE', 'READ']));

$entity = new \stdClass();
$entity->roles = App\LinuxPermissionEnum::getValue([App\LinuxPermissionEnum::READ, App\LinuxPermissionEnum::WRITE]);
$entity->roles = App\LinuxPermissionEnum::getEnums(5);

foreach($entity->roles as $role) {
    echo $role->name . PHP_EOL;
}

dd();

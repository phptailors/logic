<?php

use Rector\Config\RectorConfig;
use Rector\PHPUnit\AnnotationsToAttributes\Rector\ClassMethod\DataProviderAnnotationToAttributeRector;
use Rector\PHPUnit\AnnotationsToAttributes\Rector\Class_\CoversAnnotationWithValueToAttributeRector;
use Rector\PHPUnit\PHPUnit100\Rector\Class_\StaticDataProviderClassMethodRector;
use Rector\PHPUnit\Rector\StmtsAwareInterface\WithConsecutiveRector;

return RectorConfig::configure()
    ->withPaths([
        __DIR__.'/tests/src/',
    ])
    ->withRules([
        StaticDataProviderClassMethodRector::class,
        CoversAnnotationWithValueToAttributeRector::class,
        DataProviderAnnotationToAttributeRector::class,
        WithConsecutiveRector::class,
    ])
;

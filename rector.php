<?php

// declare(strict_types=1);
//
// use Rector\Config\RectorConfig;
//
// return RectorConfig::configure()
//    ->withPaths([
//        __DIR__ . '/app',
//        __DIR__ . '/bootstrap',
//        __DIR__ . '/config',
//        __DIR__ . '/public',
//        __DIR__ . '/resources',
//        __DIR__ . '/routes',
//        __DIR__ . '/tests',
//    ])
//    // uncomment to reach your current PHP version
//    // ->withPhpSets()
//    ->withTypeCoverageLevel(0)
//    ->withDeadCodeLevel(0)
//    ->withCodeQualityLevel(0);

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictTypedCallRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnUnionTypeRector;
use Rector\TypeDeclaration\Rector\Closure\AddClosureVoidReturnTypeWhereNoReturnRector;
use Rector\TypeDeclaration\Rector\StmtsAwareInterface\DeclareStrictTypesRector;
use RectorLaravel\Set\LaravelSetProvider;

return RectorConfig::configure()
    ->withPaths([
        __DIR__.'/app',
        __DIR__.'/bootstrap',
        __DIR__.'/config',
        __DIR__.'/database',
        __DIR__.'/resources',
        __DIR__.'/routes',
        __DIR__.'/tests',
    ])
    ->withSkip([
        __DIR__.'/bootstrap/cache',
        __DIR__.'/storage',
        __DIR__.'/vendor',
        AddClosureVoidReturnTypeWhereNoReturnRector::class,
        ReturnTypeFromStrictTypedCallRector::class,
        ReturnUnionTypeRector::class,
        DeclareStrictTypesRector::class => [
            __DIR__.'/resources/views',
        ],
    ])
    ->withPhpSets()
    ->withSetProviders(LaravelSetProvider::class)
    ->withComposerBased(laravel: true)
    ->withPreparedSets(
        deadCode: true,
        codeQuality: true,
        typeDeclarations: true,
        privatization: true,
        earlyReturn: true,
    )

    ->withRules([
        DeclareStrictTypesRector::class,
    ]);

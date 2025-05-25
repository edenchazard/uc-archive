<?php

declare(strict_types=1);

use PhpCsFixer\Fixer\ArrayNotation\ArraySyntaxFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;

return ECSConfig::configure()
    ->withPaths([
        __DIR__ . '/app',
        __DIR__ . '/tests',
        __DIR__ . '/routes',
        __DIR__ . '/config',
    ])
    ->withRules([
        ArraySyntaxFixer::class,
    ])
    ->withPreparedSets(
        psr12: true,
        arrays: true,
        docblocks: true,
        spaces: true,
        namespaces: true,
        controlStructures: true,
        cleanCode: true,
    );

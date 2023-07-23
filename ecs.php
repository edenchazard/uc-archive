<?php

declare(strict_types=1);

use PhpCsFixer\Fixer\ArrayNotation\ArraySyntaxFixer;
use PhpCsFixer\Fixer\ClassNotation\ClassAttributesSeparationFixer;
use PhpCsFixer\Fixer\ClassNotation\OrderedClassElementsFixer;
use PhpCsFixer\Fixer\ControlStructure\NoBreakCommentFixer;
use PhpCsFixer\Fixer\Operator\BinaryOperatorSpacesFixer;
use PhpCsFixer\Fixer\Operator\UnaryOperatorSpacesFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocNoEmptyReturnFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;
use Symplify\EasyCodingStandard\ValueObject\Option;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function (ECSConfig $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();
    $parameters->set(Option::PATHS, [
        __DIR__ . '/app',
        __DIR__ . '/tests',
    ]);

    $containerConfigurator->import(SetList::SPACES);
    $containerConfigurator->import(SetList::ARRAY);
    $containerConfigurator->import(SetList::DOCBLOCK);
    $containerConfigurator->import(SetList::NAMESPACES);
    $containerConfigurator->import(SetList::CONTROL_STRUCTURES);
    $containerConfigurator->import(SetList::CLEAN_CODE);
    $containerConfigurator->import(SetList::PSR_12);

    $services = $containerConfigurator->services();
    $services->set(ArraySyntaxFixer::class)
        ->call('configure', [[
            'syntax' => 'short',
        ]]);

    $parameters->set(Option::SKIP, [
        // BinaryOperatorSpacesFixer::class,
        ClassAttributesSeparationFixer::class,
        PhpdocNoEmptyReturnFixer::class,
        // UnaryOperatorSpacesFixer::class,
        NoBreakCommentFixer::class,
        OrderedClassElementsFixer::class,
    ]);
};

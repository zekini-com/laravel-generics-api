<?php

use PhpCsFixer\Fixer\ArrayNotation\ArraySyntaxFixer;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\EasyCodingStandard\ValueObject\Option;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->import(SetList::CLEAN_CODE);
    $containerConfigurator->import(SetList::COMMENTS);
    $containerConfigurator->import(SetList::COMMON);
    $containerConfigurator->import(SetList::CONTROL_STRUCTURES);
    $containerConfigurator->import(SetList::DOCBLOCK);
    $containerConfigurator->import(SetList::NAMESPACES);
    $containerConfigurator->import(SetList::PSR_12);
    $containerConfigurator->import(SetList::SPACES);
    $containerConfigurator->import(SetList::STRICT);

    $parameters = $containerConfigurator->parameters();

    $parameters->set(Option::PARALLEL, true);

    $parameters->set(Option::SKIP, [
        'Variable assignment found within a condition. Did you mean to do a comparison ?',
    ]);

    $parameters->set(Option::PATHS, [
        __DIR__ . '/app',
        __DIR__ . '/config',
        __DIR__ . '/database',
        __DIR__ . '/tests',
    ]);

    $services = $containerConfigurator->services();
    $services->set(ArraySyntaxFixer::class)
        ->call('configure', [[
            'syntax' => 'short',
        ]]);

};

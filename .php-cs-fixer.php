<?php

$finder = PhpCsFixer\Finder::create();

$finder
    ->in([
        __DIR__ . '/src',
    ])
    ->exclude([

    ])
    ->notName('*.html.php')
    ->notName('*.html.twig');

$config = new PhpCsFixer\Config();
$config
    ->setRules([
        '@PSR1' => true,
        '@PSR12' => true,
        '@Symfony' => true,
        'declare_strict_types' => true,
        'phpdoc_to_return_type' => true,
        'no_unused_imports' => true,
        'strict_param' => true,
        'return_type_declaration' => true,
        'no_superfluous_phpdoc_tags' => true,
        'array_syntax' => ['syntax' => 'short'],
        'concat_space' => ['spacing' => 'one'],
        'binary_operator_spaces' => ['default' => 'single_space'],
        'blank_line_before_statement' => ['statements' => ['break', 'continue', 'declare', 'return', 'throw', 'try', 'for', 'foreach', 'while', 'switch', 'if']],
    ])
    ->setFinder($finder)
    ->setCacheFile(__DIR__ . '/.php_cs.cache');

return $config;

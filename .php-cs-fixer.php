<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
    ->exclude('var');

return (new PhpCsFixer\Config())
    ->setRules([
        '@Symfony' => true,
        'array_syntax' => [
            'syntax' => 'short',
        ],
        'concat_space' => [
            'spacing' => 'one',
        ],
        'declare_strict_types' => true,
        'escape_implicit_backslashes' => true,
        'global_namespace_import' => [
            'import_classes' => true,
            'import_constants' => true,
            'import_functions' => true,
        ],
        'group_import' => false,
        'header_comment' => false,
        'list_syntax' => [
            'syntax' => 'short',
        ],
        'mb_str_functions' => true,
        'method_argument_space' => [
            'on_multiline' => 'ensure_fully_multiline',
        ],
        'method_chaining_indentation' => true,
        'multiline_whitespace_before_semicolons' => [
            'strategy' => 'new_line_for_chained_calls',
        ],
        'native_function_invocation' => true,
        'no_null_property_initialization' => true,
        'no_superfluous_elseif' => true,
        'no_superfluous_phpdoc_tags' => [
            'allow_mixed' => true,
            'remove_inheritdoc' => false,
            'allow_unused_params' => false,
        ],
        'no_unreachable_default_argument_value' => false,
        'no_unset_on_property' => true,
        'no_useless_else' => true,
        'no_useless_return' => true,
        'ordered_class_elements' => true,
        'ordered_imports' => [
            'imports_order' => [
                'class',
                'function',
                'const',
            ],
            'sort_algorithm' => 'alpha',
        ],
        'php_unit_dedicate_assert' => true,
        'php_unit_expectation' => true,
        'php_unit_method_casing' => true,
        'php_unit_set_up_tear_down_visibility' => true,
        'phpdoc_align' => [
            'align' => 'vertical',
        ],
        'phpdoc_order' => true,
        'phpdoc_order_by_value' => true,
        'phpdoc_separation' => false,
        'phpdoc_to_comment' => false,
        'phpdoc_to_return_type' => true,
        'phpdoc_var_without_name' => false,
        'pow_to_exponentiation' => true,
        'return_assignment' => true,
        'single_import_per_statement' => false,
        'single_line_throw' => false,
        'strict_comparison' => false,
        'strict_param' => true,
        'ternary_to_null_coalescing' => true,
        'visibility_required' => [
            'elements' => [
                'property',
                'method',
                'const',
            ],
        ],
        'yoda_style' => false,
    ])
    ->setFinder($finder);

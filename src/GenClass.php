<?php

namespace Inilim\GenClass;

use Inilim\GenClass\TableItem;
use Inilim\GenClass\ColumnItem;
use Inilim\GenClass\TwigWrap;
use Inilim\GenClass\ConstItem;

class GenClass
{
    /**
     * @param TableItem $table
     * @param ColumnItem[] $cols
     * @param class-string|null $extends
     * @param ConstItem[] $const
     */
    function __invoke(
        TableItem $table,
        array $cols,
        string $dir,
        TwigWrap $twig,
        string $namespace,
        array $const = [],
        string $prefix_class_name = '',
        string $postfix_class_name = '',
        ?string $extends = null,
        bool $readonly   = false,
        bool $final      = false,
        bool $abstract   = false,
    ) {
        // de(123123);

        $vars = [
            'table'     => [
                'name'          => $prefix_class_name . \_str()->ucfirst(\_str()->camel($table->name)) . $postfix_class_name,
                'original_name' => $table->name,
            ],
            'const' => $const,
            'extends'   => [
                'exists'     => $extends !== null,
                'class_name' => \basename($extends ?? ''),
                'use'        => $extends,
            ],
            // 'prefix_class_name'  => $prefix_class_name,
            // 'postfix_class_name' => $postfix_class_name,
            'cols'      => $cols,
            'readonly'  => $readonly,
            'final'     => $final,
            'abstract'  => $abstract,
            'namespace' => $namespace,
        ];

        // de($vars);

        $str_class = $twig->render('class', $vars);

        \file_put_contents(\sprintf('%s/%s.php', $dir, $vars['table']['name']), $str_class);

        // de();
    }
}

<?php

namespace Inilim\GenClass;

use Inilim\GenClass\TableItem;
use Inilim\GenClass\ColumnItem;
use Inilim\GenClass\TwigWrap;
use Inilim\GenClass\ConstItem;

/**
 */
class GenClassAllowDynamicProps
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
        /**
         * если имя класса хочется указать самому
         */
        ?string $my_class_name = null,
        /**
         * если имя файла хочется указать самому
         */
        ?string $my_file_name  = null,
        array $const = [],
        string $prefix_class_name = '',
        string $postfix_class_name = '',
        ?string $extends = null,
        bool $final      = false,
        bool $abstract   = false,
    ) {
        // de(123123);

        if ($my_class_name !== null) {
            $class_name = $prefix_class_name . $my_class_name . $postfix_class_name;
        } else {
            $class_name = $prefix_class_name . \_str()->ucfirst(\_str()->camel($table->name)) . $postfix_class_name;
        }


        $vars = [
            'class_name' => $class_name,
            'table'      => $table,
            'const'      => $const,

            'extends'   => [
                'exists'     => $extends !== null,
                'class_name' => \basename($extends ?? ''),
                'use'        => $extends,
            ],
            // 'prefix_class_name'  => $prefix_class_name,
            // 'postfix_class_name' => $postfix_class_name,
            'cols'      => $cols,
            'final'     => $final,
            'abstract'  => $abstract,
            'namespace' => $namespace,
        ];

        // de($vars);

        $class_code = $twig->render('class_allow_dynamic_properties', $vars);
        $name_file  = $my_file_name ?? $class_name;

        \file_put_contents(\sprintf('%s/%s.php', $dir, $name_file), $class_code);

        // de();
    }
}

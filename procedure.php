<?php

require_once __DIR__ . '/vendor/autoload.php';

use Inilim\Dump\Dump;
use Inilim\GenClass\ColumnItem;
use Inilim\GenClass\ConstItem;
use Inilim\GenClass\TableItem;
use Inilim\GenClass\GenClass;
use Inilim\GenClass\GenClassAllowDynamicProps;
use Inilim\IPDO\IPDOMySQL;
use Inilim\GenClass\InitTwig;

Dump::init();

\define('BASE_NAME', 'noks_local');
$db        = new IPDOMySQL(BASE_NAME, 'root', '', \_int(), \_arr(), 'MySQL-8.0');
$gen_class = new GenClass;
$gen_class_adp = new GenClassAllowDynamicProps;
\define('DIR_CLASS', __DIR__ . '/class');
\define('_NAMESPACE', 'Noks\Model\Item');
$twig = (new InitTwig)->get();
$sql_list_tables      = \sprintf('SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = "%s"', BASE_NAME);
$sql_table_info       = \sprintf('SELECT * FROM information_schema.columns WHERE table_schema = "%s" AND table_name = :table_name', BASE_NAME);
// $sql_table_info_short = \sprintf('SHOW COLUMNS FROM :table_name FROM "%s"', BASE_NAME);

// ------------------------------------------------------------------
// 
// ------------------------------------------------------------------

$tables = $db->exec($sql_list_tables, 2);
$tables = \array_column($tables, 'TABLE_NAME');

// ------------------------------------------------------------------
// 
// ------------------------------------------------------------------

// \shuffle($tables);

foreach ($tables as $table) {
    $table = new TableItem($table);
    // d($table);

    $info = $db->exec($sql_table_info, [
        'table_name' => $table->name
    ], 2);

    $info = \_arr()->keysLowerNestedArray($info);

    $info = \_arr()->onlyNestedArray($info, [
        'is_nullable',
        'column_name',
        'data_type',
    ]);

    // de($info);

    $info = \_arr()->map($info, function ($col) {
        $col['is_nullable'] = $col['is_nullable'] === 'YES' ? true : false;
        $col['data_type']   = match ($col['data_type']) {
            // string
            'json',
            'timestamp', 'date', 'datetime', 'time',
            'longtext', 'tinytext', 'mediumtext',  'text',
            'mediumblob', 'longblob', 'tinyblob', 'blob',
            'varchar' => 'string',
            // int
            'bigint', 'mediumint', 'smallint', 'tinyint', 'int' => 'int',
            // float
            'float', 'double' => 'float',
        };

        return new ColumnItem(
            name: $col['column_name'],
            is_null: $col['is_nullable'],
            type: $col['data_type'],
        );
    });

    // de(\var_export($table->name, true));

    $const = [
        // new ConstItem(
        //     name: 'TABLE_NAME',
        //     value_export: \var_export($table->name, true),
        // ),
    ];

    // $gen_class->__invoke(
    //     $table,
    //     $info,
    //     DIR_CLASS,
    //     $twig,
    //     _NAMESPACE,
    //     prefix_class_name: 'GenClass_',
    //     const: $const,
    //     props_outside_construct: true,
    //     extends: GenClass::class,
    // );

    $gen_class_adp->__invoke(
        $table,
        $info,
        DIR_CLASS,
        $twig,
        _NAMESPACE,
        prefix_class_name: 'GenClass_',
        const: $const,
        // extends: GenClass::class,
    );

    // de($info);
}



// de($tables);

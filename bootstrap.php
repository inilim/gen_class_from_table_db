<?php

use GenClass\TwigWrap;
use GenClass\InitTwig;
use Inilim\IPDO\IPDOMySQL;

\define('ROOT_DIR', __DIR__);


function twig(): TwigWrap
{
    static $o = null;
    return $o ??= (new InitTwig)->get();
}

function db(): IPDOMySQL
{
    static $o = null;
    return $o ??= new IPDOMySQL(BASE_NAME, 'root', '', \_int(), \_arr(), 'MySQL-8.0');
}

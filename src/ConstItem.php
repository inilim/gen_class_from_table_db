<?php

namespace Inilim\GenClass;

final readonly class ConstItem
{
    public string $value_export;

    function __construct(
        public string $name,
        $value,
        public string $visibility = 'public',
    ) {
        $this->value_export = \var_export($value, true);
    }
}

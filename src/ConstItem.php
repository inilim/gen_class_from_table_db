<?php

namespace Inilim\GenClass;

final readonly class ConstItem
{
    function __construct(
        public string $name,
        public string $value_export,
        public string $visibility = 'public',
    ) {
    }
}

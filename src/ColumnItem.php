<?php

namespace Inilim\GenClass;

final readonly class ColumnItem
{
    function __construct(
        public string $name,
        public bool $is_null,
        public string $type,
        public string $visibility = 'public',
    ) {
    }
}

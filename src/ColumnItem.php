<?php

namespace Inilim\GenClass;

final  class ColumnItem
{
    protected string $name;
    protected bool $is_null;
    protected string $type;
    protected string $visibility = 'public';

    function __construct(
        string $name,
        bool $is_null,
        string $type,
        string $visibility = 'public'
    ) {
        $this->name = $name;
        $this->is_null = $is_null;
        $this->type = $type;
        $this->visibility = $visibility;
    }
}

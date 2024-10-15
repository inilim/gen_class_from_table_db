<?php

namespace Inilim\GenClass;

final class TableItem
{
    protected string $name;

    function __construct(
        string $name
    ) {
        $this->name = $name;
    }

    function getName(): string
    {
        return $this->name;
    }
}

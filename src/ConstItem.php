<?php

declare(strict_types=1);

namespace Inilim\GenClass;

final class ConstItem
{
    protected string $name;
    protected string $valueExport;
    protected string $visibility;

    function __construct(
        string $name,
        $value,
        string $visibility = 'public'
    ) {
        $this->name        = $name;
        $this->valueExport = \var_export($value, true);
        $this->visibility  = $visibility;
    }

    function getVisibility(): string
    {
        return $this->visibility;
    }

    function getName(): string
    {
        return $this->name;
    }

    function getValueExport(): string
    {
        return $this->valueExport;
    }
}

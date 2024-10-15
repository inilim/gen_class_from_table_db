<?php

declare(strict_types=1);

namespace Inilim\GenClass;

final class ColumnItem
{
    protected string $name;
    protected bool $isNull;
    protected string $type;
    protected string $visibility;

    function __construct(
        string $name,
        bool $isNull,
        string $type,
        string $visibility = 'public'
    ) {
        $this->name       = $name;
        $this->isNull     = $isNull;
        $this->type       = $type;
        $this->visibility = $visibility;
    }

    function getType(): string
    {
        return $this->type;
    }

    function isNull(): bool
    {
        return $this->isNull;
    }

    function getVisibility(): string
    {
        return $this->visibility;
    }

    function getName(): string
    {
        return $this->name;
    }
}

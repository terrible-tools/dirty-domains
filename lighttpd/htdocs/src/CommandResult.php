<?php

declare(strict_types=1);

namespace TerribleTools\DirtyDomains;

final class CommandResult
{
    public readonly int $statusCode;
    public readonly mixed $payload;

    public function __construct(int $statusCode, mixed $payload)
    {
        $this->statusCode = $statusCode;
        $this->payload = $payload;
    }
}

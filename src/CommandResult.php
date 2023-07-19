<?php

declare(strict_types=1);

namespace TerribleTools\DirtyDomains;

final class CommandResult
{
    public readonly int $statusCode;
    public readonly object|array $payload;

    public function __construct(int $statusCode, object|array $payload)
    {
        $this->statusCode = $statusCode;
        $this->payload = $payload;
    }
}

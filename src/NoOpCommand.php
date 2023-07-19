<?php

declare(strict_types=1);

namespace TerribleTools\DirtyDomains;

use TerribleTools\DirtyDomains\{Command, CommandResult};

final class NoOpCommand implements Command
{
    private readonly int $_statusCode;
    private readonly object $_payload;
    public function __construct(int $statusCode = 500, object $payload = null)
    {
        $this->_statusCode = $statusCode;
        $this->_payload = $payload;
    }

    public function execute() : CommandResult
    {
        return new CommandResult($this->_statusCode, $this->_payload);
    }
}

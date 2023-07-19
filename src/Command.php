<?php

declare(strict_types=1);

namespace TerribleTools\DirtyDomains;

use TerribleTools\DirtyDomains\CommandResult;

interface Command
{
    public function execute() : CommandResult;
}

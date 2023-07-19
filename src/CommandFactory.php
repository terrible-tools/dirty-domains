<?php

declare(strict_types=1);

namespace TerribleTools\DirtyDomains;

use TerribleTools\DirtyDomains\Command;
use TerribleTools\DirtyDomains\LookupCommand;
use TerribleTools\DirtyDomains\NoOpCommand;

final class CommandFactory
{
    /**
     * Creates the proper command froma given command string
     * 
     * @param string $commandLine Has the form `command/then/args/separated/by/forward/slashes`.
     * 
     * @return Command
     */
    public static function createCommand(string $commandLine) : Command
    {
        list( $command , $argv ) = explode('/', $commandLine, 2);
        switch (strtolower($command))
        {
            case 'lookup':
                return new LookupCommand($argv);
        }
        return new NoOpCommand(payload: false);
    }
}

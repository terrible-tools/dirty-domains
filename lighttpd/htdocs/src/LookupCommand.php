<?php

declare(strict_types=1);

namespace TerribleTools\DirtyDomains;

use TerribleTools\DirtyDomains\Command;
use TerribleTools\DirtyDomains\CommandResult;
use TerribleTools\DirtyDomains\NoOpCommand;

final class LookupCommand implements Command
{
    private readonly string $_qtype;
    private readonly string $_qname;
    private readonly Command $_lookupBehavior;

    public function __construct(string $argv)
    {
        $args = explode('/', $argv);
        $this->_qname = $args[0];
        $this->_qtype = $args[1] ?? ''; // TODO : come up with a better way to handle invalid input

        switch ($this->_qtype) {
            case 'SOA':
                $this->_lookupBehavior = new SoaCommand($this->_qname);
                break;

            default:
                $this->_lookupBehavior = new NoOpCommand(payload: false);
                break;
        }
    }

    public function execute() : CommandResult
    {
        return $this->_lookupBehavior->execute();
    }
}

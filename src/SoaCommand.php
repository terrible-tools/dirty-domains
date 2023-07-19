<?php

declare(strict_types=1);

namespace TerribleTools\DirtyDomains;

use TerribleTools\DirtyDomains\Command;
use TerribleTools\DirtyDomains\CommandResult;
use TerribleTools\DirtyDomains\NoOpCommand;

final class SoaCommand implements Command
{
    private readonly string $_NAME;
    private const _TYPE = 'SOA';
    private const _TTL = 3600;
    private readonly string $_MNAME;
    private const _RNAME = 'admin.example.com.';
    private const _SERIAL = '2023071801';
    private const _REFRESH = '86400';
    private const _RETRY = '7200';
    private const _EXPIRE = '3600000';
    private const _MINIMUM = '172800';
    // the values above are part of the SOA record, the values below are part of the response to PowerDNS
    private const _DOMAIN_ID = -1;

    public function __construct(string $queriedName)
    {
        $this->_NAME = $queriedName;
        $this->_MNAME = $this->_NAME;
    }

    public function execute() : CommandResult
    {
        $payload = array(array(
            'qtype' => SoaCommand::_TYPE,
            'qname' => $this->_NAME,
            'content' => join(' ', array($this->_NAME, SoaCommand::_TYPE, SoaCommand::_SERIAL, SoaCommand::_REFRESH, SoaCommand::_RETRY, SoaCommand::_EXPIRE, SoaCommand::_MINIMUM)),
            'ttl' => SoaCommand::_TTL,
            'domain_id' => SoaCommand::_DOMAIN_ID,
        ));
        return new CommandResult(200, $payload);
    }
}

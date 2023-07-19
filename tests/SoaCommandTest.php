<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use TerribleTools\DirtyDomains\SoaCommand;

final class SoaCommandTest extends TestCase
{
    public function testExactlyOneRecordReturned(): void
    {
        $sut = new SoaCommand("www.example.com.");

        $actual = $sut->execute()->payload;

        $this->assertCount(1, $actual);
    }
}

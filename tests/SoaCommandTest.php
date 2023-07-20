<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use TerribleTools\DirtyDomains\SoaCommand;

final class SoaCommandTest extends TestCase
{
    public function testExactlyOneRecordReturned(): void
    {
        $expected = 1;
        $sut = new SoaCommand('www.example.com.');

        $actual = $sut->execute()->payload;

        $this->assertCount($expected, $actual);
    }
    
    public function testSOARecordTypeReturned(): void
    {
        $expected = 'SOA';
        $sut = new SoaCommand('www.example.com.');

        $actual = $sut->execute()->payload[0]['qtype'];

        $this->assertSame($expected, $actual);
    }

    public function testQueriedNameReturned(): void
    {
        $expected = 'www.example.com.';
        $sut = new SoaCommand($expected);

        $actual = $sut->execute()->payload[0]['qname'];
        
        $this->assertSame($expected, $actual);
    }

    public function testPrimaryNameserverReturned(): void
    {
        $expected = 'www.example.com.';
        $sut = new SoaCommand($expected);

        $position = 0;
        $actual = explode(' ', $sut->execute()->payload[0]['content'], $position + 2)[$position];
        
        $this->assertSame($expected, $actual);
    }

    public function testHostmasterAddressReturned(): void
    {
        $expected = 'admin.example.com.';
        $sut = new SoaCommand('www.example.com.');

        $position = 1;
        $actual = explode(' ', $sut->execute()->payload[0]['content'], $position + 2)[$position];
        
        $this->assertSame($expected, $actual);
    }

    public function testProperSerialReturned(): void
    {
        $expected = '2023071801'; // format is yyyyMMdd followed by 2 digit number
        $sut = new SoaCommand('www.example.com.');

        $position = 2;
        $actual = explode(' ', $sut->execute()->payload[0]['content'], $position + 2)[$position];
        
        $this->assertSame($expected, $actual);
    }

    public function testRefreshTimeReturned(): void
    {
        $expected = '86400';
        $sut = new SoaCommand('www.example.com.');

        $position = 3;
        $actual = explode(' ', $sut->execute()->payload[0]['content'], $position + 2)[$position];
        
        $this->assertSame($expected, $actual);
    }

    public function testRetryTimeReturned(): void
    {
        $expected = '7200';
        $sut = new SoaCommand('www.example.com.');

        $position = 4;
        $actual = explode(' ', $sut->execute()->payload[0]['content'], $position + 2)[$position];
        
        $this->assertSame($expected, $actual);
    }

    public function testExpireTimeReturned(): void
    {
        $expected = '3600000';
        $sut = new SoaCommand('www.example.com.');

        $position = 5;
        $actual = explode(' ', $sut->execute()->payload[0]['content'], $position + 2)[$position];
        
        $this->assertSame($expected, $actual);
    }

    public function testMinimumTtlReturned(): void
    {
        $expected = '172800';
        $sut = new SoaCommand('www.example.com.');

        $position = 6;
        $actual = explode(' ', $sut->execute()->payload[0]['content'], $position + 2)[$position];
        
        $this->assertSame($expected, $actual);
    }
}

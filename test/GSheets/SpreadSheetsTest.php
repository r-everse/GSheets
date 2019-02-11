<?php

namespace REverse\GSheets\Tests;

use PHPUnit\Framework\TestCase;
use REverse\GSheets\Client;
use REverse\GSheets\SpreadSheets;

class SpreadSheetsTest extends TestCase
{
    public function testDeclareRowRangeReturnAnExpectedString()
    {
        $client = $this->prophesize(Client::class);
        $spreadSheets = new SpreadSheets($client->reveal(), 'foo');

        $range = $spreadSheets->declareRowRange('Sheet1', 1, 10);

        $this->assertEquals('Sheet1!1:10', $range);
    }
}

<?php

namespace REverse\GSheets\Tests\Operation;

use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use REverse\GSheets\Client;
use REverse\GSheets\Operation\Write;
use REverse\GSheets\SpreadSheets;
use REverse\GSheets\Value;

class WriteTest extends TestCase
{
    const SPREADSHEET_TEST_ID = 'test';

    public function testExecuteMethodCalAppendNativeMethod()
    {
        $spreadsheet = $this->prophesize(SpreadSheets::class);
        $spreadsheet->getSpreadSheetId()->willReturn(self::SPREADSHEET_TEST_ID);

        $client = $this->prophesize(Client::class);
        $googleServiceSheets = $this->prophesize(\Google_Service_Sheets::class);
        $spreadSheetsValues = $this->prophesize(\Google_Service_Sheets_Resource_SpreadsheetsValues::class);

        $value = $this->getMockBuilder(Value::class)->disableOriginalConstructor()->getMock();
        $googleSheetsValueRange = $this->getMockBuilder(\Google_Service_Sheets_ValueRange::class)->disableOriginalConstructor()->getMock();
        $value->method('getGoogleSheetsValueRange')->willReturn($googleSheetsValueRange);

        $spreadSheetsValues->append(
            Argument::exact(self::SPREADSHEET_TEST_ID),
            Argument::exact('Sheet1'),
            Argument::exact($googleSheetsValueRange),
            Argument::exact(Write::DEFAULT_PARAMS)
        )->shouldBeCalledTimes(1);

        $googleServiceSheets->spreadsheets_values = $spreadSheetsValues->reveal();
        $client->getGoogleServiceSheets()->willReturn($googleServiceSheets->reveal());
        $spreadsheet->getClient()->willReturn($client->reveal());

        $write = new Write($spreadsheet->reveal());
        $write->execute($value, 'Sheet1');
    }
}

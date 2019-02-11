<?php

namespace REverse\GSheets\Tests\Operation;

use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use REverse\GSheets\Client;
use REverse\GSheets\Operation\Clear;
use REverse\GSheets\SpreadSheets;

class ClearTest extends TestCase
{
    const SPREADSHEET_TEST_ID = 'test';

    public function testExecuteMethodCallClearNativeMethodLikeExpected()
    {
        $spreadsheet = $this->prophesize(SpreadSheets::class);
        $spreadsheet->getSpreadSheetId()->willReturn(self::SPREADSHEET_TEST_ID);

        $client = $this->prophesize(Client::class);
        $googleServiceSheets = $this->prophesize(\Google_Service_Sheets::class);
        $spreadSheetsValues = $this->prophesize(\Google_Service_Sheets_Resource_SpreadsheetsValues::class);
        $googleServiceSheets->spreadsheets_values = $spreadSheetsValues->reveal();

        $spreadSheetsValues->clear(
            Argument::exact(self::SPREADSHEET_TEST_ID),
            'Sheet1!1:2',
            Argument::type(\Google_Service_Sheets_ClearValuesRequest::class)
        )->shouldBeCalledTimes(1);

        $spreadsheet->getClient()->willReturn($client->reveal());
        $client->getGoogleServiceSheets()->willReturn($googleServiceSheets->reveal());

        $clear = new Clear($spreadsheet->reveal());
        $clear->execute('Sheet1!1:2');
    }
}

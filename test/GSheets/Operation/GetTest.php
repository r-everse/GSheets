<?php

namespace REverse\GSheets\Tests\Operation;

use PHPUnit\Framework\TestCase;
use REverse\GSheets\Client;
use REverse\GSheets\Operation\Get;
use REverse\GSheets\SpreadSheets;

class GetTest extends TestCase
{
    const SPREADSHEET_TEST_ID = 'test';

    public function testExecuteMethodCallGetNativeMethodLikeExpected()
    {
        $spreadsheet = $this->prophesize(SpreadSheets::class);
        $spreadsheet->getSpreadSheetId()->willReturn(self::SPREADSHEET_TEST_ID);

        $client = $this->prophesize(Client::class);
        $googleServiceSheets = $this->prophesize(\Google_Service_Sheets::class);
        $spreadSheetsValues = $this->prophesize(\Google_Service_Sheets_Resource_SpreadsheetsValues::class);
        $googleServiceSheets->spreadsheets_values = $spreadSheetsValues->reveal();

        $spreadSheetsValues->get(
            self::SPREADSHEET_TEST_ID,
            'Sheet1!1:1'
        )->shouldBeCalledTimes(1);

        $spreadsheet->getClient()->willReturn($client->reveal());
        $client->getGoogleServiceSheets()->willReturn($googleServiceSheets->reveal());

        $get = new Get($spreadsheet->reveal());
        $get->execute('Sheet1!1:1');
    }
}

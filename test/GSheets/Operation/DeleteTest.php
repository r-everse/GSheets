<?php

namespace REverse\GSheets\Tests\Operation;

use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use REverse\GSheets\Client;
use REverse\GSheets\Operation\Delete;
use REverse\GSheets\SpreadSheets;

class DeleteTest extends TestCase
{
    const SPREADSHEET_TEST_ID = 'test';

    public function testExecuteMethodCallBatchUpdateToRemoveColumnsOrRows()
    {
        $spreadsheet = $this->prophesize(SpreadSheets::class);
        $spreadsheet->getSpreadSheetId()->willReturn(self::SPREADSHEET_TEST_ID);

        $client = $this->prophesize(Client::class);
        $googleServiceSheets = $this->prophesize(\Google_Service_Sheets::class);
        $spreadSheetsResource = $this->prophesize(\Google_Service_Sheets_Resource_Spreadsheets::class);

        $spreadSheetsResource->batchUpdate(
            Argument::exact(self::SPREADSHEET_TEST_ID),
            Argument::type(\Google_Service_Sheets_BatchUpdateSpreadsheetRequest::class)
        )->shouldBeCalledTimes(1);

        $googleServiceSheets->spreadsheets = $spreadSheetsResource->reveal();
        $client->getGoogleServiceSheets()->willReturn($googleServiceSheets->reveal());
        $spreadsheet->getClient()->willReturn($client->reveal());

        $delete = new Delete($spreadsheet->reveal());
        $delete->execute(Delete::DIMENSION_ROWS, 'Sheet1', 0, 1);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage TEST is not a valid dimension
     */
    public function testExecuteThrowExceptionIfPassedAnInvalidDimension()
    {
        $spreadsheets = $this->prophesize(SpreadSheets::class);

        $delete = new Delete($spreadsheets->reveal());
        $delete->execute('TEST', 'Sheet1', 0, 2);
    }
}

<?php

namespace REverse\GSheets\Tests;

use PHPUnit\Framework\TestCase;
use REverse\GSheets\Value;

class ValueTest extends TestCase
{
    public function testGetGoogleSheetsValueRangeReturnAnExpectedInstance()
    {
        $value = new Value('test', 'value');

        $googleValue = $value->getGoogleSheetsValueRange();

        $this->assertInstanceOf(\Google_Service_Sheets_ValueRange::class, $googleValue);
    }
}

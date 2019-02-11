<?php

namespace REverse\GSheets;

class Value
{
    /**
     * @var \Google_Service_Sheets_ValueRange
     */
    private $googleSheetsValueRange;

    /**
     * GoogleSheetsValue constructor.
     *
     * @param array $values
     */
    public function __construct(...$values)
    {
        $this->googleSheetsValueRange = new \Google_Service_Sheets_ValueRange([
            'values' => [
                $values,
            ],
        ]);
    }

    /**
     * @return \Google_Service_Sheets_ValueRange
     */
    public function getGoogleSheetsValueRange()
    {
        return $this->googleSheetsValueRange;
    }
}

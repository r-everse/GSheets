<?php

namespace REverse\GSheets\Operation;

class Get extends Operation
{
    /**
     * This method returns values in range.
     * Range is A1 Notation
     *
     * @param $range
     *
     * @return \Google_Service_Sheets_ValueRange
     */
    public function execute($range)
    {
        $service = $this->spreadsheets->getClient()->getGoogleServiceSheets();

        return $service->spreadsheets_values->get($this->spreadsheets->getSpreadSheetId(), $range);
    }
}
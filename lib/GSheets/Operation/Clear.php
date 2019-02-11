<?php

namespace REverse\GSheets\Operation;

class Clear extends Operation
{
    public function execute($range)
    {
        $service = $this->spreadsheets->getClient()->getGoogleServiceSheets();
        $service->spreadsheets_values->clear(
            $this->spreadsheets->getSpreadSheetId(),
            $range,
            new \Google_Service_Sheets_ClearValuesRequest()
        );
    }
}

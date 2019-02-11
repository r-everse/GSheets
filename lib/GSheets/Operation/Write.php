<?php

namespace REverse\GSheets\Operation;

use REverse\GSheets\Value;

class Write extends Operation
{
    const DEFAULT_PARAMS = [
        'valueInputOption' => 'RAW'
    ];

    public function execute(Value $value, $range, $params = [])
    {
        if (empty($params)) {
            $params = self::DEFAULT_PARAMS;
        }

        $service = $this->spreadsheets->getClient()->getGoogleServiceSheets();
        $service->spreadsheets_values->append(
            $this->spreadsheets->getSpreadSheetId(),
            $range,
            $value->getGoogleSheetsValueRange(),
            $params
        );
    }
}

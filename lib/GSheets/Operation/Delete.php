<?php

namespace REverse\GSheets\Operation;

class Delete extends Operation
{
    const DIMENSION_ROWS = 'ROWS';
    const DIMENSION_COLUMNS = 'COLUMNS';

    /**
     * This operation consists to remove columns or row by a sheet.
     * For example if I want remove first 2 rows from Sheet1 I'll do this call:
     *
     * $get->execute('ROWS', 'Sheet1', 0, 1)
     *
     * @param string $dimension
     * @param string $sheetId
     * @param int $startIndex
     * @param int $endIndex
     *
     * @return \Google_Service_Sheets_BatchUpdateSpreadsheetResponse
     */
    public function execute($dimension, $sheetId, $startIndex, $endIndex)
    {
        if ($dimension !== self::DIMENSION_ROWS && $dimension !== self::DIMENSION_COLUMNS) {
            throw new \InvalidArgumentException(sprintf("%s is not a valid dimension", $dimension));
        }

        $dimensionRange = new \Google_Service_Sheets_DimensionRange();
        $dimensionRange->setSheetId($sheetId);
        $dimensionRange->setDimension($dimension);
        $dimensionRange->setStartIndex($startIndex);
        $dimensionRange->setEndIndex($endIndex);
        $deleteDimensionRange = new \Google_Service_Sheets_DeleteDimensionRequest();
        $deleteDimensionRange->setRange($dimensionRange);

        $deleteDimensionRangeRequest = new \Google_Service_Sheets_Request();
        $deleteDimensionRangeRequest->setDeleteDimension($deleteDimensionRange);
        $request = new \Google_Service_Sheets_BatchUpdateSpreadsheetRequest();
        $request->setRequests([$deleteDimensionRangeRequest]);

        $service = $this->spreadsheets->getClient()->getGoogleServiceSheets();

        return $service->spreadsheets->batchUpdate(
            $this->spreadsheets->getSpreadSheetId(),
            $request
        );
    }
}

<?php

namespace REverse\GSheets;

use REverse\GSheets\Operation\Append;
use REverse\GSheets\Operation\Clear;
use REverse\GSheets\Operation\Update;

class SpreadSheets
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var string
     */
    private $spreadSheetId;

    /**
     * @var string
     */
    private $range;

    /**
     * @param Client $client
     * @param string $spreadSheetId
     * @param string $range
     */
    public function __construct(Client $client, $spreadSheetId, $range = "")
    {
        $this->client = $client;
        $this->spreadSheetId = $spreadSheetId;
        $this->range = $range;
    }

    /**
     * @param Value $value
     * @param $range
     * @param $optParams
     *
     * @return self
     */
    public function update(Value $value, $range, $optParams)
    {
        $this->range = $range;

        (new Update($this))->execute($value, $this->range, $optParams);

        return $this;
    }

    /**
     * @param Value $value
     * @param $range
     * @param $optParams
     *
     * @return self
     */
    public function append(Value $value, $range, $optParams)
    {
        $this->range = $range;

        (new Append($this))->execute($value, $this->range, $optParams);

        return $this;
    }

    /**
     * @param $range
     *
     * @return self
     */
    public function clear($range)
    {
        $this->range = $range;

        (new Clear($this))->execute($this->range);

        return $this;
    }

    /**
     * @param Value $value
     * @param $sheet
     * @param $row
     * @param array $optParams
     *
     * @return self
     */
    public function updateRow(Value $value, $sheet, $row, $optParams = [])
    {
        $this->range = $this->declareRowRange($sheet, $row, $row);

        $this->update($value, $this->range, $optParams);

        return $this;
    }

    /**
     * @param string $sheet
     * @param string $row
     *
     * @return self
     */
    public function clearRow($sheet, $row)
    {
        $this->range = $this->declareRowRange($sheet, $row, $row);

        $this->clear($this->range);

        return $this;
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @return string
     */
    public function getSpreadSheetId()
    {
        return $this->spreadSheetId;
    }

    /**
     * @param $range
     *
     * @return self
     */
    public function setRange($range)
    {
        $this->range = $range;

        return $this;
    }

    /**
     * Return last range used to write on spreadsheet
     *
     * @return string
     */
    public function getRange()
    {
        return $this->range;
    }

    /**
     * This method apply A1 notation to declare row range on sheet chosen
     *
     * @link https://developers.google.com/sheets/api/guides/concepts
     *
     * @param string $sheet
     * @param int $rowStart
     * @param int $rowEnd
     *
     * @return string
     */
    public function declareRowRange($sheet, $rowStart, $rowEnd)
    {
        return $sheet.'!'.$rowStart.':'.$rowEnd;
    }
}

<?php

namespace REverse\GSheets\Operation;

use REverse\GSheets\SpreadSheets;

abstract class Operation
{
    /**
     * @var SpreadSheets
     */
    protected $spreadsheets;

    public function __construct(SpreadSheets $spreadsheets)
    {
        $this->spreadsheets = $spreadsheets;
    }
}

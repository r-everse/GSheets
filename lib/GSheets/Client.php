<?php

namespace REverse\GSheets;

class Client
{
    const DRIVE = \Google_Service_Sheets::DRIVE;
    const DRIVE_FILE = \Google_Service_Sheets::DRIVE_FILE;
    const DRIVE_READONLY = \Google_Service_Sheets::DRIVE_READONLY;
    const SPREADSHEETS = \Google_Service_Sheets::SPREADSHEETS;
    const SPREADSHEETS_READONLY = \Google_Service_Sheets::SPREADSHEETS_READONLY;
    const DEFAULT_SCOPES = [
        self::DRIVE,
        self::DRIVE_FILE,
        self::DRIVE_READONLY,
        self::SPREADSHEETS,
        self::SPREADSHEETS_READONLY,
    ];

    /**
     * @var \Google_Client
     */
    private $googleClient;

    /**
     * @var \Google_Service_Sheets
     */
    private $googleServiceSheets;

    /**
     * @param \Google_Client $googleClient
     * @param string $scope
     */
    public function __construct(\Google_Client $googleClient, $scope = null)
    {
        $this->googleClient = $googleClient;
        $this->setScope($scope);

        $this->googleServiceSheets = new \Google_Service_Sheets($this->googleClient);
    }

    private function setScope($scope)
    {
        if ($scope !== null && ! in_array($scope, self::DEFAULT_SCOPES)) {
            throw new \InvalidArgumentException(sprintf("%s is not a valid scope", $scope));
        }

        if ($scope === null) {
            $this->googleClient->setScopes(self::DEFAULT_SCOPES);
        } else {
            $this->googleClient->addScope($scope);
        }
    }

    /**
     * @return \Google_Service_Sheets
     */
    public function getGoogleServiceSheets()
    {
        return $this->googleServiceSheets;
    }
}

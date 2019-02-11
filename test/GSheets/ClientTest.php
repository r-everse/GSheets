<?php

namespace REverse\GSheets\Tests;

use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use REverse\GSheets\Client;

class ClientTest extends TestCase
{
    public function testConstructorCallSetScopesIfScopeIsNotPassedToConstructor()
    {
        $googleClient = $this->prophesize(\Google_Client::class);

        $googleClient->setScopes(Argument::exact(Client::DEFAULT_SCOPES))->shouldBeCalled();
        new Client($googleClient->reveal());
    }

    public function testGetGoogleServiceSheetsReturnAnExpectedInstance()
    {
        $googleClient = $this->prophesize(\Google_Client::class);
        $client = new Client($googleClient->reveal());

        $googleServiceSheets = $client->getGoogleServiceSheets();

        $this->assertInstanceOf(\Google_Service_Sheets::class, $googleServiceSheets);
    }
}

<?php

namespace AssetZen\Tests;

use AssetZen\Client;
use PHPUnit\Framework\TestCase;


class AssetZenClientTest extends TestCase
{
    public function testOK()
    {
      $this->assertInstanceOf(Client::class, new Client()) ;
    }
}

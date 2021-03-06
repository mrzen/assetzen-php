<?php

namespace AssetZen\Tests;

use AssetZen\Client;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Psr7\Response;

use AssetZen\Models\Account;


class AssetZenClientTest extends TestCase
{
    public function testCreate()
    {
      $this->assertInstanceOf(Client::class, new Client([
        'base_uri' => 'http://localhost:3000',
        'auth' => [
            'code' => '8c7f62044c4a3de12e5da9e25560a2521c1c24948aa782d3488a76e75aca7054',
            'client_id' => '047277b82d8aee8fb7e48efc3a33e1a38250bd4bd3648f9fb4f296767e4227b2',
            'client_secret' => '047277b82d8aee8fb7e48efc3a33e1a38250bd4bd3648f9fb4f296767e4227b2'
          ]
        ]
        )) ;
    }

    public function testAccount()
    {
      $client = getTestClient([
        new Response(200, ['Content-Type' => 'application/json'], mock('/account.json'))
      ]);

      $account = $client->account();

      $this->assertInstanceOf(Account::class, $account);
    }
}

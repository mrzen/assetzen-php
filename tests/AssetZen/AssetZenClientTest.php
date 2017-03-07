<?php

namespace AssetZen\Tests;

use AssetZen\Client;
use PHPUnit\Framework\TestCase;


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

    public function testGetImagesNoParams()
    {
      $client = getTestClient();

      $images = $client->getImages();

      // Images are an array
      $this->assertInternalType('array', $images);

      foreach($images as $image) $this->assertInstanceOf(\AssetZen\Models\Image::class, $image);
    }

    public function testGetImagesCount()
    {
      $client = getTestClient();

      $images = $client->getImages(1, 24);

      $this->assertEquals(count($images), 24);
    }
}

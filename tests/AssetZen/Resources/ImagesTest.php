<?php

namespace AssetZen\Tests;

use AssetZen\Client;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;


class ImagesTest extends TestCase
{

    public function testGetImagesNoParams()
    {
      $client = getTestClient([
        new Response(200, [], mock('/images.json'))
      ]);

      $images = $client->getImages();

      // Images are an array
      $this->assertInternalType('array', $images);

      foreach($images as $image) $this->assertInstanceOf(\AssetZen\Models\Image::class, $image);
    }
}

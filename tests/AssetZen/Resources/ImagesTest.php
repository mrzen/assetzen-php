<?php

namespace AssetZen\Tests;

use AssetZen\Client;
use PHPUnit\Framework\TestCase;


class ImagesTest extends TestCase
{

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

      $images = $client->getImages(0, 23);

      $this->assertEquals(count($images), 23);
    }
}

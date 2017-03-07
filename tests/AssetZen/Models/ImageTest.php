<?php
namespace AssetZen\Tests\Models;

use AssetZen\Models\ImageParameters;
use AssetZen\Models\Image;
use PHPUnit\Framework\TestCase;


class ImageTest extends TestCase
{

  public function testGetLink()
  {
    $client = \AssetZen\Tests\getTestClient();
    $p = new ImageParameters();
    $p->width = 1920;
    $p->height = 1080;
    $p->quality = 70;
    $p->format = 'jpg';

    $image = new Image(['id' => 'TEST_IMAGEID'], $client);
    $sample = 'https://assetzen-images.mrzen.com/image/rMn-bGitIiW0DeIC_v5HilwZTiIW6v2TK5ov3gobPNc.eyJpbWFnZUlkIjoiVEVTVF9JTUFHRUlEIiwid2lkdGgiOjE5MjAsImhlaWdodCI6MTA4MCwicXVhbGl0eSI6NzB9.jpg';

    //$this->assertEquals($image->getLink($p), $sample);
  }
}

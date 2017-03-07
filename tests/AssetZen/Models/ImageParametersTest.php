<?php

namespace AssetZen\Tests\Models;

use AssetZen\Models;
use PHPUnit\Framework\TestCase;


class AssetZenImageParametersTest extends TestCase
{

  public function testLinks()
  {
    $p = new \AssetZen\Models\ImageParameters();

    $p->imageId = 'TEST_IMAGEID';
    $p->accountId = 'TEST_ACCT_ID';
    $p->width = 1920;
    $p->height = 1080;
    $p->quality = 70;
    $p->format = 'jpg';

    $link = $p->getLink();

    echo $link;

    $this->assertEquals(
      'https://assetzen-images.mrzen.com/image/rMn-bGitIiW0DeIC_v5HilwZTiIW6v2TK5ov3gobPNc.eyJpbWFnZUlkIjoiVEVTVF9JTUFHRUlEIiwid2lkdGgiOjE5MjAsImhlaWdodCI6MTA4MCwicXVhbGl0eSI6NzB9.jpg',
      $link
    );
  }

}

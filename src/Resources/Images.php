<?php


namespace AssetZen\Resources;

use AssetZen\Models\Image;


trait Images {

  public function getImage($id)
  {
    $r = $this->get('/images/'.$id.'.json');

    $data = json_decode($r->getBody());

    return new Image($data, $this);
  }

  public function getImages($page = 1, $count = 100)
  {
      $r = $this->get('/images.json', ['query' => ['page' => $page, 'count' => $count]]);

      $data = json_decode($r->getBody());

      return array_map(
        function($image) {
          return new Image($image, $this);
        }, $data->images);
  }
}

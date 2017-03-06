<?php

namespace AssetZen\Models;


class Image extends \stdClass {

  /**
  * @var API Client
  */
  private $_client;

  /**
  * Constructor
  *
  * @param array $data Image Data
  *
  * @param &\AsetZen\Client $client Client which created this image.
  */
  public function __construct(array $data = [], \AssetZen\Client &$client = null)
  {
    foreach($data as $k => $v) {
      $this->$k = $v;
    }

    if ($client) {
      $this->_client = $client;
    }
  }

  public function getLink(LinkParams $params){
    
  }

}

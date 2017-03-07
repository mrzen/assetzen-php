<?php

namespace AssetZen\Models;

/**
 * Base API Model
 *
 */
class Base extends \stdClass {

  /**
  * @var API Client
  */
  private $_client;

  /**
  * Constructor
  *
  * @param array $data Model Data
  *
  * @param &\AsetZen\Client $client Client which created this model.
  */
  public function __construct($data = [], \AssetZen\Client &$client = null)
  {
    foreach($data as $k => $v) {
      $this->$k = $v;
    }

    if ($client) {
      $this->_client = $client;
    }
  }
}

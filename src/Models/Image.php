<?php

namespace AssetZen\Models;


/**
 * {@inheritdoc}
 *
 */
class Image extends Base {

  /**
   * Get a link for this image
   *
   * @param $params Link Parameters
   *
   * @return string Image Link
   */
  public function getLink(ImageParameters $params)
  {
    $account = $this->_client->account();
    $params->imageId = $this->id;
    $params->accountId = $account->id;
    $params->host = $account->settings->images_service;

    return $params->getLink();
  }
}

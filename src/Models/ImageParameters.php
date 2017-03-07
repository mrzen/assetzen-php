<?php


namespace AssetZen\Models;


class ImageParameters
{

  const DEFAULT_HOST = 'https://assetzen-images.mrzen.com';

  /**
   * @var Image ID
   */
  public $imageId;

  /**
   * @var Account ID - Used to sign requests
   */
  public $accountId;

  /**
   * @var Width (pixels)
   */
  public $width;

  /**
   * @var Height (pixels)
   */
  public $height;

  /**
   * @var JPEG Quality Factor
   */
  public $quality;

  /**
   * @var GIF Color Pallette Size
   */
  public $colors;

  /**
   * @var Ignore Focus
   */
  public $ignoreFocus;

  /**
   * @var Image Format
   */
  public $format;

  /**
   * @var Overridden Focus Point
   */
  public $focus;

  /**
  * Get a link to view the image
  *
  * @return string Link
  */
  public function getLink()
  {
    $parameters = [
      'imageId' => $this->imageId,
      'width' => (int)$this->width,
      'height' => (int)$this->height,
      'quality' => (int)$this->quality,
      'colors' => (int)$this->colors,
      'ignoreFocus' => (bool)$this->ignoreFocus
    ];

    if($this->focus) {
      $parameters['focus'] = $focus;
    }

    $parameters = array_filter($parameters, function($item) {
        // Filter out all falsey values
        return ($item !== null) && ($item !== 0) && ($item !== false);
    });

    $ps = json_encode($parameters);

    // Sign the JSON
    $hmac = hash_hmac("sha256", $ps, $this->accountId, true);
    $signature = $this->urlSafeBase64Encode($hmac);

    $url = self::DEFAULT_HOST . '/image/' . $signature . '.' . $this->urlSafeBase64Encode($ps);

    if ($this->format) {
        $url .= '.'.$this->format;
    }

    return $url;
  }


  /**
   * URL Safe Base64 encode
   *
   * @param string $value Value to encode
   *
   * @return string Encoded value
   */
  public function urlSafeBase64Encode($value)
  {
      $v = base64_encode($value);

      $v = str_replace('=', '', $v);
      $v = str_replace('/', '_', $v);
      $v = str_replace('+', '-', $v);

      return $v;
  }
}

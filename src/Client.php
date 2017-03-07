<?php

/**
 * © 2017 Mr.Zen Ltd
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, US.A
 */

namespace AssetZen;

use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Sainsburys\Guzzle\Oauth2\Middleware\OAuthMiddleware;
use Sainsburys\Guzzle\Oauth2\GrantType\AuthorizationCode;
use Sainsburys\Guzzle\Oauth2\AccessToken;

use AssetZen\Resources\Images;
use AssetZen\Resources\Albums;


class Client extends \GuzzleHttp\Client {

    /**
     * @var Account ID
     */
    private $_accountId;

    /**
     * @var Handler / Middleware Stack
     */
    private $_stack;

    /**
     * @var History
     */
    private $_history;

    // Include access methods
    use Images;
    use Albums;


    /**
     * Create a New Client
     *
     * @param array|string $config Configuration Source / options
     */
    public function __construct($config = null)
    {
      $this->_stack = HandlerStack::create();
      $this->_history = [];
      $configuration = $this->getConfiguration($config);

      $token = false;

      if (array_key_exists('access_token', $configuration)) {
        $token = new AccessToken($configuration['access_token']['token'], 'token', $configuration['access_token']['data']);
      }

      parent::__construct(['handler' => $this->_stack, 'auth' => 'oauth2', 'base_uri' => $configuration['base_uri']]);

      $configuration['auth'][AuthorizationCode::CONFIG_TOKEN_URL] = '/oauth/token';
      $grant = new AuthorizationCode($this, $configuration['auth']);
      $oauth = new OAuthMiddleware($this, $grant);
      $history = Middleware::history($this->_history);

      if($token) $oauth->setAccessToken($token);

      $this->_stack->push($oauth->onBefore());
      $this->_stack->push($oauth->onFailure(5));
      $this->_stack->push($history);
    }

    public function history(){
      return $this->_history;
    }

    /**
     * Get Configuration
     *
     *
     */
    public function getConfiguration($config = null)
    {
      if ($config) return $this->loadConfiguration($config);

      if ( isset($_SERVER['CONFIG']) ) return $this->loadConfiguration($config);

      return [];
    }

    /**
     * Load Configuration
     *
     * Load Configuration settings
     *
     * @param array|string $config Configuration Source
     */
    public function loadConfiguration($config)
    {
        if (is_string($config)) {
          if (file_exists($config)) {
            return json_decode(file_get_contents($config), true);
          } else {
            return json_decode($config, true);
          }
        }

        if (is_array($config)) return $config;
    }
}

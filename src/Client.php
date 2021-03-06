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

use League\OAuth2\Client\Grant\AuthorizationCode;
use League\OAuth2\Client\Provider\GenericProvider;

class Client extends \GuzzleHttp\Client {

    /**
     * @var Account
     */
    private $_account;

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
    public function __construct($config = null, $stack = null)
    {

      $provider = new GenericProvider($config);

      $accessToken = $provider->getAccessToken('authorization_code', [
      
        'code' => $config['auth']['code']
      
      ]);

      var_dump($accessToken);die;

    }

    public function history(){
      return $this->_history;
    }

    public function account()
    {
      if($this->_account) return $account;

      $r = $this->get('/account.json');

      $data = json_decode($r->getBody());

      $this->_account = new Account($data, $this);

      return $this->_account;
    }

    public function push($middleware)
    {
      $this->_stack->push($middleware);
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

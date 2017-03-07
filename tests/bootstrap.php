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

namespace AssetZen\Tests;

use GuzzleHttp\Handler\MockHandler;

$loaderPath = dirname(__DIR__) . '/vendor/autoload.php';
$loader = require $loaderPath;

define('MOCK', dirname(__DIR__) . '/tests/mock');

use AssetZen\Client;

error_reporting(-1);
date_default_timezone_set('UTC');

// Ensure composer is up-to-date
if (!file_exists(dirname(__DIR__) . '/composer.lock')) {
    die("Dependencies must be installed using composer:\n\nphp composer.phar install\n\n"
        . "See http://getcomposer.org for help with installing composer\n");
}


// Set the config file if not provided by CLI
if (!isset($_SERVER['CONFIG'])) {
    $serviceConfig = dirname(__DIR__) . 'test_services.json';

    if (file_exists($serviceConfig)) {
        $_SERVER['CONFIG'] = $serviceConfig;
    }
}

function getTestClient(array $responses = [])
{
    // Instantiate the client
    $config = ( isset($_SERVER['CONFIG']) ? $_SERVER['CONFIG'] : 'test_config.dist.json');
    $az = new \AssetZen\Client($config, new MockHandler($responses));
    return $az;
}

function mock($uri) {
  return file_get_contents(MOCK . $uri);
}

$loader->addPsr4('AssetZen\Tests\\', dirname(__DIR__) . '/tests/Trovebox');

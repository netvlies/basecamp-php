<?php
/*
* (c) Netvlies Internetdiensten
*
* Richard van den Brand <richard@netvlies.net>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

if (!file_exists(dirname(__DIR__) . '/composer.lock')) {
    die("Dependencies must be installed using composer:\n\nphp composer.phar install\n\n"
        . "See http://getcomposer.org for help with installing composer\n");
}

$loader = require dirname(__DIR__) . '/vendor/autoload.php';
$loader->add('Basecamp\\Test', __DIR__);

Guzzle\Tests\GuzzleTestCase::setMockBasePath(__DIR__ . '/mock');

Guzzle\Tests\GuzzleTestCase::setServiceBuilder(Guzzle\Service\Builder\ServiceBuilder::factory(array(
    'basecamp' => array(
        'class' => 'Basecamp\BasecampClient',
        'params' => array(
            'auth'          => 'http',
            'username'      => 'test_user',
            'password'      => '****',
            'user_id'       => '99999999',
            'app_name'      => 'Basecamp PHP Test',
            'app_contact'   => 'https://github.com/netvlies/basecamp-php'
        )
    )
)));

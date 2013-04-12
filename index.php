<?php
/*
* (c) Netvlies Internetdiensten
*
* Richard van den Brand <richard@netvlies.net>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

require __DIR__.'/vendor/autoload.php';

$service = \Basecamp\BasecampClient::factory(array(
    'auth'     => 'oauth',
    'token'    => 'Wtj4htewhtuewhuoitewh',
    'userId'   => 1815898
));

var_dump($service->getDocument(1010968, 1134733));



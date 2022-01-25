<?php
/*
* (c) Netvlies Internetdiensten
*
* Richard van den Brand <richard@netvlies.net>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace Basecamp;

use Guzzle\Common\Collection;
use Guzzle\Service\Client;
use Guzzle\Service\Description\ServiceDescription;
use Guzzle\Common\Event;
use Guzzle\Common\Exception\InvalidArgumentException;

class BasecampClient extends Client
{
    /**
     * @param array $config
     * @return \Guzzle\Service\Client|BasecampClient
     * @throws \Guzzle\Common\Exception\InvalidArgumentException
     */
    public static function factory($config = array())
    {
        $default = array(
            'base_url'      => 'https://3.basecampapi.com/{user_id}/',
            'token'         => null,
        );
        $required = array('user_id', 'app_name', 'app_contact');
        $config = Collection::fromConfig($config, $default, $required);
        $client = new self($config->get('base_url'), $config);


        if (! isset($config['token'])) {
            throw new InvalidArgumentException("Config must contain token when using oauth");
        }
        $authorization = sprintf('Bearer %s', $config['token']);

        if (! isset($authorization)) {
            throw new InvalidArgumentException("Config must contain valid authentication method");
        }

        // Attach a service description to the client
        $description = ServiceDescription::factory(__DIR__ . '/Resources/service.php');
        $client->setDescription($description);

        // Set required User-Agent
        $client->setUserAgent(sprintf('%s (%s)', $config['app_name'], $config['app_contact']));

        $client->getEventDispatcher()->addListener('request.before_send', function(Event $event) use ($authorization) {
            $event['request']->addHeader('Authorization', $authorization);

        });

        return $client;
    }
}

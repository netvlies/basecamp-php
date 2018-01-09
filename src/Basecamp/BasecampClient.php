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

use GuzzleHttp\Client;
use GuzzleHttp\Command\Guzzle\GuzzleClient;
use GuzzleHttp\Command\Guzzle\Description;
use Guzzle\Service\Loader\PhpLoader;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\EventDispatcher\Event;
use InvalidArgumentException;

class BasecampClient extends Client
{
    /**
     * @param array $config
     * @return \GuzzleHttp\Client|BasecampClient
     * @throws \InvalidArgumentException
     */
    public static function factory($config = array())
    {
        if (! isset($config['account_id'], $config['app_name'], $config['app_contact'])) {
            throw new InvalidArgumentException("Config must contain account_id, app_name and app_contact. See: https://github.com/basecamp/bc3-api (Identifying your application)."); 
        }


        $default = ['auth' => 'http', 'token' => null, 'username' => null, 'password' => null];

        $config = array_merge($default, $config);

        if ($config['auth'] === 'http') {
            if (! isset($config['username'], $config['password'])) {
                throw new InvalidArgumentException("Config must contain username and password when using http auth");
            }
            $authorization = 'Basic ' . base64_encode($config['username'] . ':' . $config['password']);
        }
        if ($config['auth'] === 'oauth') {
            if (! isset($config['token'])) {
                throw new InvalidArgumentException("Config must contain token when using oauth");
            }
            $authorization = sprintf('Bearer %s', $config['token']);
        }
        if (! isset($authorization)) {
            throw new InvalidArgumentException("Config must contain valid authentication method");
        }

        // Attach a service description to the client
        $configDirectories = array(__DIR__ . '/Resources');
        $locator = new FileLocator($configDirectories);
        $phpLoader = new PhpLoader($locator);
        $description = $phpLoader->load($locator->locate('service.php'));
        $description = new Description($description);


        $httpOptions = [
            'base_uri' => "https://3.basecampapi.com/{$config['account_id']}/",
            'headers' => [
                'User-Agent' => sprintf('%s (%s)', $config['app_name'], $config['app_contact']),
                'Authorization' => $authorization,
            ]
        ];

        $client = new self($httpOptions);

        $guzzleClient = new GuzzleClient($client, $description);

        return $guzzleClient;
    }
}

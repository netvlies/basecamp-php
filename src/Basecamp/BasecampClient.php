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
            'base_url'      => 'https://basecamp.com/{user_id}/api/{version}/',
            'version'       => 'v1',
            'auth_method'   => 'http',
            'token'         => null,
            'username'      => null,
            'password'      => null
        );
        $required = array('user_id', 'auth_method');
        $config = Collection::fromConfig($config, $default, $required);
        $client = new self($config->get('base_url'), $config);

        if ($config['auth'] === 'http') {
            if (! isset($config['username'], $config['password'])) {
                throw new InvalidArgumentException("Config must contain username and password when using http auth");
            }
            $authoritzation = 'Basic ' . base64_encode($config['username'] . ':' . $config['password']);
        }
        if ($config['auth'] === 'oauth') {
            if (! isset($config['token'])) {
                throw new InvalidArgumentException("Config must contain token when using oath");
            }
            $authoritzation = sprintf('Bearer %s', $config['token']);
        }
        if (! isset($authoritzation)) {
            throw new InvalidArgumentException("Config must contain valid authentication method");
        }

        // Attach a service description to the client
        $description = ServiceDescription::factory(__DIR__ . '/Resources/service.php');
        $client->setDescription($description);

        $client->getEventDispatcher()->addListener('request.before_send', function(Event $event) use ($authoritzation) {
            $event['request']->addHeader('Authorization', $authoritzation);
        });

        return $client;
    }

    /**
     * @return mixed
     */
    public function getProjects()
    {
        return $this->execute($this->getCommand('GetProjects'));
    }

    /**
     * @param $id
     * @return array|mixed
     */
    public function getProject($projectId)
    {
        return $this->execute($command = $this->getCommand('GetProject', array(
            'id' => $projectId
        )));
    }

    /**
     * @param $id
     * @return array|mixed
     */
    public function getDocumentsByProject($projectId)
    {
        return $this->execute($command = $this->getCommand('GetDocumentsByProject', array(
            'id' => $projectId
        )));
    }

    public function getDocument($projectId, $documentId)
    {
        return $this->execute($command = $this->getCommand('GetDocument', array(
            'projectId'     => $projectId,
            'documentId'    => $documentId
        )));
    }

    public function getTopicsByProject($projectId)
    {
        return $this->execute($command = $this->getCommand('GetTopicsByProject', array(
            'projectId'     => $projectId,
        )));
    }

    public function getTodolistsByProject($projectId)
    {
        return $this->execute($command = $this->getCommand('GetTodolistsByProject', array(
            'projectId'     => $projectId,
        )));
    }

    /**
     * @param int $projectId
     * @param string $name The name of the todo list.
     * @param string $description The description of the todolist.
     * @return array The created todo list.
     */
    public function createTodolistByProject($projectId, $name, $description)
    {
        return $this->execute($this->getCommand('CreateTodolistByProject', array(
            'projectId'   => $projectId,
            'name'        => $name,
            'description' => $description,
        )));
    }

    public function getAttachmentsByProject($projectId)
    {
         return $this->execute($command = $this->getCommand('GetAttachmentsByProject', array(
            'projectId'     => $projectId,
        )));
    }

}

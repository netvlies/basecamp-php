<?php
/*
* (c) Netvlies Internetdiensten
*
* Richard van den Brand <richard@netvlies.net>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace Basecamp\Test;

use Basecamp\BasecampClient;

class BasecampClientTest extends \Guzzle\Tests\GuzzleTestCase
{
    public function testFactoryInitializesClient()
    {
        $client = BasecampClient::factory(array(
            'auth'     => 'http',
            'username' => 'foo',
            'password' => 'bar',
            'user_id'  => '999999999',
            'version'  => 'v2'
        ));
        $this->assertEquals('https://basecamp.com/999999999/api/v2/', $client->getBaseUrl());
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testFactoryInitializesClientWithoutAuth()
    {
        $client = BasecampClient::factory(array(
            'username' => 'foo',
            'password' => 'bar',
            'user_id'  => '999999999',
            'version'  => 'v2'
        ));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testFactoryInitializesClientWithoutUserId()
    {
        $client = BasecampClient::factory(array(
            'auth'     => 'http',
            'username' => 'foo',
            'password' => 'bar',
            'version'  => 'v2'
        ));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testFactoryInitializesClientWithoutToken()
    {
        $client = BasecampClient::factory(array(
            'auth'     => 'oauth',
            'username' => 'foo',
            'password' => 'bar',
            'version'  => 'v2'
        ));
    }

    public function testFactoryInitializesClientWithToken()
    {
        $client = BasecampClient::factory(array(
            'auth'     => 'oauth',
            'token'    => 'foo',
            'version'  => 'v2',
            'user_id'  => '999999999',
        ));
        $this->assertEquals('https://basecamp.com/999999999/api/v2/', $client->getBaseUrl());
    }

    public function testGetProjects()
    {
        $client = $this->getServiceBuilder()->get('basecamp');
        $this->setMockResponse($client, array(
            'get_projects'
        ));
        $response = $client->getProjects();
        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey(0, $response);
        $this->assertArrayHasKey('id', $response[0]);
        $this->assertSame(99999, $response[0]['id']);
    }

    public function testGetProject()
    {
        $client = $this->getServiceBuilder()->get('basecamp');
        $this->setMockResponse($client, array(
            'get_project'
        ));
        $response = $client->getProject(1);
        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey('id', $response);
        $this->assertSame(1, $response['id']);
        $this->assertArrayHasKey('topics', $response);
    }

    public function testGetDocumentsByProject()
    {
        $client = $this->getServiceBuilder()->get('basecamp');
        $this->setMockResponse($client, array(
            'get_documents_by_project'
        ));
        $response = $client->getDocumentsByProject(1);
        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey(0, $response);
        $this->assertSame(12343, $response[0]['id']);
    }

    public function testGetDocument()
    {
        $client = $this->getServiceBuilder()->get('basecamp');
        $this->setMockResponse($client, array(
            'get_document'
        ));
        $response = $client->getDocument(123, 456);
        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey('id', $response);
        $this->assertSame(123, $response['id']);
    }

    public function testGetTopicsByProject()
    {
        $client = $this->getServiceBuilder()->get('basecamp');
        $this->setMockResponse($client, array(
            'get_topics_by_project'
        ));
        $response = $client->getTopicsByProject(1);

        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey('id', $response[0]);
        $this->assertSame(3, $response[0]['id']);
    }

    public function testGetTodolistsByProject()
    {
        $client = $this->getServiceBuilder()->get('basecamp');
        $this->setMockResponse($client, array(
            'get_todolists_by_project'
        ));
        $response = $client->getTodolistsByProject(1);
        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey('id', $response[0]);
        $this->assertSame(3, $response[0]['id']);
    }

    public function testCreateTodolistByProject()
    {
        $client = $this->getServiceBuilder()->get('basecamp');
        $this->setMockResponse($client, array(
            'create_todolist_by_project'
        ));
        $todolist = "Support (inbound)";
        $todolist_desc = "Lorem ipsum";
        $response = $client->createTodolistByProject(1, $todolist, $todolist_desc);
        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey('id', $response);
        $this->assertArrayHasKey('name', $response);
        $this->assertArrayHasKey('description', $response);
        $this->assertSame(3, $response['id']);
        $this->assertSame($todolist, $response['name']);
        $this->assertSame($todolist_desc, $response['description']);
    }

    public function testGetAttachmentsByProject()
    {
        $client = $this->getServiceBuilder()->get('basecamp');
        $this->setMockResponse($client, array(
            'get_attachments_by_project'
        ));
        $response = $client->getAttachmentsByProject(1);

        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey('key', $response[0]);
        $this->assertSame('93e10dacd3aa64ab2edde55642c751f1e7b2557e', $response[0]['key']);
    }
}

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
            'auth'          => 'http',
            'username'      => 'foo',
            'password'      => 'bar',
            'user_id'       => '999999999',
            'version'       => 'v2',
            'app_name'      => 'Fake',
            'app_contact'   => 'test@fake.com'
        ));
        $this->assertEquals('https://basecamp.com/999999999/api/v2/', $client->getBaseUrl());
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testFactoryInitializesClientWithoutAuth()
    {
        $client = BasecampClient::factory(array(
            'username'      => 'foo',
            'password'      => 'bar',
            'user_id'       => '999999999',
            'version'       => 'v2',
            'app_name'      => 'Fake',
            'app_contact'   => 'test@fake.com'
        ));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testFactoryInitializesClientWithoutUserId()
    {
        $client = BasecampClient::factory(array(
            'auth'          => 'http',
            'username'      => 'foo',
            'password'      => 'bar',
            'version'       => 'v2',
            'app_name'      => 'Fake',
            'app_contact'   => 'test@fake.com'
        ));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testFactoryInitializesClientWithoutToken()
    {
        $client = BasecampClient::factory(array(
            'auth'          => 'oauth',
            'username'      => 'foo',
            'password'      => 'bar',
            'version'       => 'v2',
            'app_name'      => 'Fake',
            'app_contact'   => 'test@fake.com'
        ));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testFactoryInitializesClientWithoutIdentification()
    {
        $client = BasecampClient::factory(array(
            'auth'     => 'oauth',
            'username' => 'foo',
            'password' => 'bar',
            'version'  => 'v2'
        ));
    }

    public function testFactoryInitializesClientWithIdentification()
    {
        $client = BasecampClient::factory(array(
            'auth'          => 'oauth',
            'username'      => 'foo',
            'password'      => 'bar',
            'version'       => 'v2',
            'user_id'       => '999999999',
            'app_name'      => 'Fake',
            'app_contact'   => 'test@fake.com'
        ));

        $request = $client->get();
        $this->assertEquals('Fake (test@fake.com)', (string) $request->getHeader('User-Agent'));
    }

    public function testFactoryInitializesClientWithToken()
    {
        $client = BasecampClient::factory(array(
            'auth'          => 'oauth',
            'token'         => 'foo',
            'version'       => 'v2',
            'user_id'       => '999999999',
            'app_name'      => 'Fake',
            'app_contact'   => 'test@fake.com'
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
        $response = $client->getProject(array(
            'projectId' => 1
        ));
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
        $response = $client->getDocumentsByProject(array(
            'projectId' => 1
        ));
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
        $response = $client->getDocument(array(
            'projectId' => 123,
            'documentId' => 456
        ));
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
        $response = $client->getTopicsByProject(array(
            'projectId' => 1
        ));

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
        $response = $client->getTodolistsByProject(array(
            'projectId' => 1
        ));
        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey('id', $response[0]);
        $this->assertSame(3, $response[0]['id']);
    }

    public function testGetCompletedTodolistsByProject()
    {
        $client = $this->getServiceBuilder()->get('basecamp');
        $this->setMockResponse($client, array(
            'get_completed_todolists_by_project'
        ));
        $response = $client->getCompletedTodolistsByProject(array(
            'projectId' => 1
        ));
        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey('id', $response[0]);
        $this->assertSame(7091994, $response[0]['id']);
        $this->assertSame("Support (inbound)", $response[0]['name']);
        $this->assertSame("Lorem ipsum", $response[0]['description']);
    }

    public function testCreateTodolistByProject()
    {
        $client = $this->getServiceBuilder()->get('basecamp');
        $this->setMockResponse($client, array(
            'create_todolist_by_project'
        ));
        $todolist = "Support (inbound)";
        $todolistDesc = "Lorem ipsum";
        $response = $client->createTodolistByProject(array(
            'projectId' => 1,
            'name' => $todolist,
            'description' => $todolistDesc
        ));
        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey('id', $response);
        $this->assertArrayHasKey('name', $response);
        $this->assertArrayHasKey('description', $response);
        $this->assertSame(7091994, $response['id']);
        $this->assertSame($todolist, $response['name']);
        $this->assertSame($todolistDesc, $response['description']);
    }

    public function testCreateTodoByTodolist()
    {
        $client = $this->getServiceBuilder()->get('basecamp');
        $this->setMockResponse($client, array(
            'create_todo_by_todolist'
        ));
        $todo = "Subject";
        $response = $client->createTodoByTodolist(array(
            'projectId' => 1,
            'todolistId' => 7091994,
            'content' => $todo
        ));
        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey('id', $response);
        $this->assertArrayHasKey('content', $response);
        $this->assertSame(41361256, $response['id']);
        $this->assertSame($todo, $response['content']);
    }

    public function testCreateCommentByTodo()
    {
        $client = $this->getServiceBuilder()->get('basecamp');
        $this->setMockResponse($client, array(
            'create_comment_by_todo'
        ));
        $comment = "Text message.";

        $response = $client->createCommentByTodo(array(
            'projectId' => 1,
            'todoId' => 41367037,
            'content' => $comment
        ));
        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey('id', $response);
        $this->assertArrayHasKey('content', $response);
        $this->assertSame(61775464, $response['id']);
        $this->assertSame($comment, $response['content']);
    }

    public function testGetAttachmentsByProject()
    {
        $client = $this->getServiceBuilder()->get('basecamp');
        $this->setMockResponse($client, array(
            'get_attachments_by_project'
        ));
        $response = $client->getAttachmentsByProject(array(
            'projectId' => 1
        ));

        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey('key', $response[0]);
        $this->assertSame('93e10dacd3aa64ab2edde55642c751f1e7b2557e', $response[0]['key']);
    }

    public function testCreateAttachment()
    {
        $client = $this->getServiceBuilder()->get('basecamp');
        $this->setMockResponse($client, array(
            'create_attachment'
        ));
        $response = $client->createAttachment(array(
            'mimeType' => 'image/jpeg',
            'data' => "data-here"
        ));

        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey('token', $response);
        $this->assertSame('51800634-9aecec5cfd6acf939b08cd1957a3c12796ae05fa', $response['token']);
    }

    public function testGetTodolist()
    {
        $client = $this->getServiceBuilder()->get('basecamp');
        $this->setMockResponse($client, array(
            'get_todolist'
        ));
        $response = $client->getTodolist(array(
            'projectId' => 1,
            'todolistId' => 2
        ));
        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey('id', $response);
        $this->assertSame(1, $response['id']);
        $this->assertArrayHasKey('todos', $response);
        $this->assertArrayHasKey('remaining', $response['todos']);
        $this->assertArrayHasKey(0, $response['todos']['remaining']);
        $this->assertArrayHasKey('id', $response['todos']['remaining'][0]);
    }

    public function testGetCurrentUser()
    {
        $client = $this->getServiceBuilder()->get('basecamp');
        $this->setMockResponse($client, array(
            'get_current_user'
        ));
        $response = $client->getCurrentUser();

        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey('id', $response);
        $this->assertSame(1, $response['id']);
        $this->assertSame('Richard van den Brand', $response['name']);
    }

    public function testGetGlobalEvents()
    {
        $client = $this->getServiceBuilder()->get('basecamp');
        $this->setMockResponse($client, array(
            'get_global_events'
        ));
        $response = $client->getGlobalEvents();
        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey(0, $response);
        $this->assertArrayHasKey('id', $response[0]);
        $this->assertSame(99999999, $response[0]['id']);
    }
}

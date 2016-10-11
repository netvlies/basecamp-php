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
            'auth'        => 'http',
            'username'    => 'foo',
            'password'    => 'bar',
            'user_id'     => '999999999',
            'version'     => 'v2',
            'app_name'    => 'Fake',
            'app_contact' => 'test@fake.com'
        ));
        $this->assertEquals('https://basecamp.com/999999999/api/v2/', $client->getBaseUrl());
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testFactoryInitializesClientWithNoUserOrPassword()
    {
        $client = BasecampClient::factory(array(
            'user_id'     => '999999999',
            'version'     => 'v2',
            'app_name'    => 'Fake',
            'app_contact' => 'test@fake.com'
        ));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testFactoryInitializesClientWithInvalidAuth()
    {
        $client = BasecampClient::factory(array(
            'username'    => 'foo',
            'password'    => 'bar',
            'user_id'     => '999999999',
            'version'     => 'v2',
            'app_name'    => 'Fake',
            'app_contact' => 'test@fake.com',
            'auth'        => 'invalid_auth_type'
        ));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testFactoryInitializesClientWithoutUserId()
    {
        $client = BasecampClient::factory(array(
            'auth'        => 'http',
            'username'    => 'foo',
            'password'    => 'bar',
            'version'     => 'v2',
            'app_name'    => 'Fake',
            'app_contact' => 'test@fake.com'
        ));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testFactoryInitializesClientWithoutToken()
    {
        $client = BasecampClient::factory(array(
            'auth'        => 'oauth',
            'username'    => 'foo',
            'password'    => 'bar',
            'version'     => 'v2',
            'app_name'    => 'Fake',
            'app_contact' => 'test@fake.com'
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
            'auth'        => 'http',
            'username'    => 'foo',
            'password'    => 'bar',
            'version'     => 'v2',
            'user_id'     => '999999999',
            'app_name'    => 'Fake',
            'app_contact' => 'test@fake.com'
        ));

        $request = $client->get();
        $this->assertEquals('Fake (test@fake.com)', (string)$request->getHeader('User-Agent'));
    }

    public function testFactoryInitializesClientWithToken()
    {
        $client = BasecampClient::factory(array(
            'auth'        => 'oauth',
            'token'       => 'foo',
            'version'     => 'v2',
            'user_id'     => '999999999',
            'app_name'    => 'Fake',
            'app_contact' => 'test@fake.com'
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
            'id' => 1
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
            'projectId'  => 123,
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

    public function testgetAssignedTodolistsByPerson()
    {
        $client = $this->getServiceBuilder()->get('basecamp');
        $this->setMockResponse($client, array(
            'get_assigned_todos'
        ));
        $response = $client->getAssignedTodolistsByPerson(array(
            'personId' => 1
        ));

        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey('id', $response[0]);
        $this->assertSame(968316918, $response[0]['id']);
        $this->assertArrayHasKey('assigned_todos', $response[0]);
        $this->assertInternalType('array', $response[0]['assigned_todos']);
        $this->assertArrayHasKey('id', $response[0]['assigned_todos'][0]);
        $this->assertSame(223304243, $response[0]['assigned_todos'][0]['id']);
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

    public function testGetCompletedTodosByProject()
    {
        $client = $this->getServiceBuilder()->get('basecamp');
        $this->setMockResponse($client, array(
            'get_completed_todos_by_project'
        ));
        $response = $client->getCompletedTodosByProject(array(
            'projectId' => 1
        ));
        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey('id', $response[0]);
        $this->assertSame(1, $response[0]['id']);
        $this->assertSame(true, $response[0]['completed']);
    }

    public function testCreateProject()
    {
        $client = $this->getServiceBuilder()->get('basecamp');
        $this->setMockResponse($client, array(
            'create_project'
        ));
        $projectName = 'Support (inbound)';
        $projectDescription = 'Lorem ipsum';
        $response = $client->createProject(array(
            'name'        => $projectName,
            'description' => $projectDescription
        ));
        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey('id', $response);
        $this->assertArrayHasKey('name', $response);
        $this->assertArrayHasKey('description', $response);
        $this->assertSame($projectName, $response['name']);
        $this->assertSame($projectDescription, $response['description']);
    }

    public function testCreateDocument()
    {
        $client = $this->getServiceBuilder()->get('basecamp');
        $this->setMockResponse($client, array(
            'create_document'
        ));
        $documentTitle = "Support (inbound)";
        $documentContent = "Lorem ipsum";
        $response = $client->createDocument(array(
            'projectId' => 1,
            'title'     => $documentTitle,
            'content'   => $documentContent
        ));
        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey('id', $response);
        $this->assertArrayHasKey('title', $response);
        $this->assertArrayHasKey('content', $response);
        $this->assertSame($documentTitle, $response['title']);
        $this->assertSame($documentContent, $response['content']);
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
            'projectId'   => 1,
            'name'        => $todolist,
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
            'projectId'  => 1,
            'todolistId' => 7091994,
            'content'    => $todo
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
            'todoId'    => 41367037,
            'content'   => $comment
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
            'data'     => "data-here"
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
            'projectId'  => 1,
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

    public function testGetAccessesByProject()
    {
        $client = $this->getServiceBuilder()->get('basecamp');
        $this->setMockResponse($client, array(
            'get_accesses_by_project'
        ));
        $response = $client->getAccessesByProject(array(
            'projectId' => 1
        ));
        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey(0, $response);
        $this->assertArrayHasKey('id', $response[0]);
        $this->assertSame(1, $response[0]['id']);
    }

    public function testGrantAccessToProject()
    {
        $client = $this->getServiceBuilder()->get('basecamp');
        $this->setMockResponse($client, array(
            'grant_access'
        ));
        $response = $client->grantAccess(array(
            'projectId' => 1,
            'ids'       => array(1, 2, 3)
        ));
        $firstAccess = $response[0];
        $this->assertInternalType('array', $firstAccess);
        $this->assertArrayHasKey('id', $firstAccess);
        $this->assertSame(1, $firstAccess['identity_id']);
    }

    public function testGetAccessesByCalendar()
    {
        $client = $this->getServiceBuilder()->get('basecamp');
        $this->setMockResponse($client, array(
            'get_accesses_by_calendar'
        ));
        $response = $client->getAccessesByCalendar(array(
            'calendarId' => 1
        ));
        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey(0, $response);
        $this->assertArrayHasKey('id', $response[0]);
        $this->assertSame(3, $response[0]['id']);
    }

    public function testGetPeople()
    {
        $client = $this->getServiceBuilder()->get('basecamp');
        $this->setMockResponse($client, array(
            'get_people'
        ));
        $response = $client->getPeople();
        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey(0, $response);
        $this->assertArrayHasKey('id', $response[0]);
        $this->assertSame(149087659, $response[0]['id']);
    }

    public function testGetSpecificUser()
    {
        $client = $this->getServiceBuilder()->get('basecamp');
        $this->setMockResponse($client, array(
            'get_person'
        ));
        $response = $client->getSpecificUser(array(
            'personId' => 149087659
        ));
        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey('id', $response);
        $this->assertSame(149087659, $response['id']);
    }

    public function testGetTodo()
    {
        $client = $this->getServiceBuilder()->get('basecamp');
        $this->setMockResponse($client, array(
            'get_todo'
        ));
        $response = $client->getTodo(array(
            'projectId' => 1,
            'todoId'    => 2,
        ));
        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey(0, $response);
        $this->assertArrayHasKey('id', $response[0]);
        $this->assertSame(1, $response[0]['id']);
        $this->assertSame(1000, $response[0]['todolist_id']);
    }

    public function testGetProjectEvents()
    {
        $client = $this->getServiceBuilder()->get('basecamp');
        $this->setMockResponse($client, array(
            'get_project_events'
        ));
        $response = $client->getProjectEvents(array(
            'projectId' => 1,
        ));
        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey(0, $response);
        $this->assertArrayHasKey('id', $response[0]);
        $this->assertSame(1054456336, $response[0]['id']);
        $this->assertSame('re-assigned a to-do to Funky ones: Design it', $response[0]['summary']);
    }

    public function testGetArchivedProjects()
    {
        $client = $this->getServiceBuilder()->get('basecamp');
        $this->setMockResponse($client, array(
            'get_archived_projects'
        ));
        $response = $client->getArchivedProjects();
        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey(0, $response);
        $this->assertArrayHasKey('id', $response[0]);
        $this->assertSame(605816632, $response[0]['id']);
    }

    public function testGetGroups()
    {
        $client = $this->getServiceBuilder()->get('basecamp');
        $this->setMockResponse($client, array(
            'get_groups'
        ));
        $response = $client->getGroups();
        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey(0, $response);
        $this->assertArrayHasKey('id', $response[0]);
        $this->assertArrayHasKey('name', $response[0]);
        $this->assertSame(12345, $response[0]['id']);
        $this->assertSame("Foo Limited", $response[0]['name']);
        $this->assertArrayHasKey(1, $response);
        $this->assertArrayHasKey('id', $response[1]);
        $this->assertArrayHasKey('name', $response[1]);
        $this->assertSame(67890, $response[1]['id']);
        $this->assertSame("Bar Associates", $response[1]['name']);
    }

    public function testGetCalendars()
    {
        $client = $this->getServiceBuilder()->get('basecamp');
        $this->setMockResponse($client, array(
            'get_calendars'
        ));
        $response = $client->getCalendars();
        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey(0, $response);
        $this->assertArrayHasKey('id', $response[0]);
        $this->assertSame(1, $response[0]['id']);
    }

    public function testGetCalendar()
    {
        $client = $this->getServiceBuilder()->get('basecamp');
        $this->setMockResponse($client, array(
            'get_calendar'
        ));
        $response = $client->getCalendar(array(
            'calendarId' => 1
        ));
        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey('id', $response);
        $this->assertSame(1, $response['id']);
    }

    public function testCreateCalendar()
    {
        $client = $this->getServiceBuilder()->get('basecamp');
        $this->setMockResponse($client, array(
            'create_calendar'
        ));
        $calendarName = 'Mock Calendar';
        $response = $client->createCalendar(array(
            'name'        => $calendarName,
        ));
        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey('id', $response);
        $this->assertArrayHasKey('name', $response);
        $this->assertSame($calendarName, $response['name']);
    }

    public function testGetAllCalendarEvents()
    {
        $client = $this->getServiceBuilder()->get('basecamp');
        $this->setMockResponse($client, array(
            'get_all_calendar_events'
        ));
        $response = $client->getAllCalendarEvents();
        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey(0, $response);
        $this->assertArrayHasKey('id', $response[0]);
        $this->assertSame(1, $response[0]['id']);
    }

    public function testGetCalendarEvents()
    {
        $client = $this->getServiceBuilder()->get('basecamp');
        $this->setMockResponse($client, array(
            'get_calendar_events'
        ));
        $response = $client->getCalendarEvents(array(
            'calendarId' => 1
        ));
        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey(0, $response);
        $this->assertArrayHasKey('id', $response[0]);
        $this->assertSame(1, $response[0]['id']);
    }

    public function testGetCalendarEventsPast()
    {
        $client = $this->getServiceBuilder()->get('basecamp');
        $this->setMockResponse($client, array(
            'get_calendar_events_past'
        ));
        $response = $client->getCalendarEvents(array(
            'calendarId' => 1
        ));
        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey(0, $response);
        $this->assertArrayHasKey('id', $response[0]);
        $this->assertSame(1, $response[0]['id']);
    }

    public function testGetCalendarEvent()
    {
        $client = $this->getServiceBuilder()->get('basecamp');
        $this->setMockResponse($client, array(
            'get_calendar_event'
        ));
        $response = $client->getCalendarEvent(array(
            'calendarId' => 1,
            'eventId' => 1
        ));
        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey('id', $response);
        $this->assertSame(1, $response['id']);
    }

    public function testCreateCalendarEvent()
    {
        $client = $this->getServiceBuilder()->get('basecamp');
        $this->setMockResponse($client, array(
            'create_calendar_event'
        ));
        $eventSummary = 'Mock Event';
        $eventStartsAt = '2015-09-17';
        $response = $client->createCalendarEvent(array(
            'calendarId' => 1,
            'summary' => $eventSummary,
            'starts_at' => $eventStartsAt,
            'all_day' => true
        ));
        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey('id', $response);
        $this->assertArrayHasKey('summary', $response);
        $this->assertSame($eventSummary, $response['summary']);
    }

    public function testGetProjectCalendarEvents()
    {
        $client = $this->getServiceBuilder()->get('basecamp');
        $this->setMockResponse($client, array(
            'get_project_calendar_events'
        ));
        $response = $client->getProjectCalendarEvents(array(
            'projectId' => 1
        ));
        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey(0, $response);
        $this->assertArrayHasKey('id', $response[0]);
        $this->assertSame(1, $response[0]['id']);
    }

    public function testGetProjectCalendarEventsPast()
    {
        $client = $this->getServiceBuilder()->get('basecamp');
        $this->setMockResponse($client, array(
            'get_project_calendar_events_past'
        ));
        $response = $client->getProjectCalendarEvents(array(
            'projectId' => 1
        ));
        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey(0, $response);
        $this->assertArrayHasKey('id', $response[0]);
        $this->assertSame(1, $response[0]['id']);
    }

    public function testGetProjectCalendarEvent()
    {
        $client = $this->getServiceBuilder()->get('basecamp');
        $this->setMockResponse($client, array(
            'get_project_calendar_event'
        ));
        $response = $client->getProjectCalendarEvent(array(
            'projectId' => 1,
            'eventId' => 1
        ));
        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey('id', $response);
        $this->assertSame(1, $response['id']);
    }

    public function testCreateProjectCalendarEvent()
    {
        $client = $this->getServiceBuilder()->get('basecamp');
        $this->setMockResponse($client, array(
            'create_project_calendar_event'
        ));
        $eventSummary = 'Mock Event';
        $eventStartsAt = '2015-09-17';
        $response = $client->createProjectCalendarEvent(array(
            'projectId' => 1,
            'summary' => $eventSummary,
            'starts_at' => $eventStartsAt,
            'all_day' => true
        ));
        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey('id', $response);
        $this->assertArrayHasKey('summary', $response);
        $this->assertSame($eventSummary, $response['summary']);
    }

}

<?php

return array(
    'serviceFullName'       => '37signals Basecamp API',
    'serviceAbbreviation'   => 'Basecamp API',
    'operations'            => array(
        'getArchivedProjects' => array(
            'httpMethod' => 'GET',
            'uri'       => 'projects/archived.json',
            'summary'   => 'Get all archived projects'
        ),
        'getProjects' => array(
            'httpMethod' => 'GET',
            'uri'       => 'projects.json',
            'summary'   => 'Get all active projects'
        ),
        'getProject' => array(
            'httpMethod' => 'GET',
            'uri'        => 'projects/{id}.json',
            'parameters' => array(
                'id' => array(
                    'location' => 'uri',
                    'description' => 'Project to retrieve by ID',
                    'required' => true
                )
            )
        ),
        'getDocumentsByProject' => array(
            'httpMethod' => 'GET',
            'uri' => 'projects/{id}/documents.json',
            'parameters' => array(
                'projectId' => array(
                    'location' => 'uri',
                    'description' => 'Retrieve documents for given project',
                    'required' => true
                )
            )
        ),
        'getDocument' => array(
            'httpMethod' => 'GET',
            'uri' => 'projects/{projectId}/documents/{documentId}.json',
            'parameters' => array(
                'projectId' => array(
                    'location' => 'uri',
                    'description' => 'Project id',
                    'required' => true
                ),
                'documentId' => array(
                    'location' => 'uri',
                    'description' => 'Document Id',
                    'required' => true
                )
            )
        ),
        'getTopicsByProject' => array(
            'httpMethod' => 'GET',
            'uri' => 'projects/{projectId}/topics.json',
            'parameters' => array(
                'projectId' => array(
                    'location' => 'uri',
                    'description' => 'Project id',
                    'required' => true
                )
            )
        ),
        'getTodolistsByProject' => array(
            'httpMethod' => 'GET',
            'uri' => 'projects/{projectId}/todolists.json',
            'parameters' => array(
                'projectId' => array(
                    'location' => 'uri',
                    'description' => 'Project id',
                    'required' => true
                )
            )
        ),
        'getCompletedTodolistsByProject' => array(
            'httpMethod' => 'GET',
            'uri' => 'projects/{projectId}/todolists/completed.json',
            'parameters' => array(
                'projectId' => array(
                    'location' => 'uri',
                    'description' => 'Project id',
                    'required' => true
                )
            )
        ),
        'createTodolistByProject' => array(
            'httpMethod' => 'POST',
            'uri' => 'projects/{projectId}/todolists.json',
            'parameters' => array(
                'projectId' => array(
                    'location' => 'uri',
                    'description' => 'Project id',
                    'required' => true
                ),
                "name" => array(
                    "location" => "json",
                    "type" => "string",
                    'required' => true,
                ),
                "description" => array(
                    "location" => "json",
                    "type" => "string",
                    'required' => true,
                )
            )
        ),
        'createTodoByTodolist' => array(
            'httpMethod' => 'POST',
            'uri' => 'projects/{projectId}/todolists/{todolistId}/todos.json',
            'parameters' => array(
                'projectId' => array(
                    'location' => 'uri',
                    'description' => 'Project id',
                    'required' => true
                ),
                'todolistId' => array(
                    'location' => 'uri',
                    'description' => 'Todo list id',
                    'required' => true
                ),
                "content" => array(
                    "location" => "json",
                    "type" => "string",
                    'required' => true,
                ),
            )
        ),
        'createCommentByTodo' => array(
            'httpMethod' => 'POST',
            'uri' => 'projects/{projectId}/todos/{todoId}/comments.json',
            'parameters' => array(
                'projectId' => array(
                    'location' => 'uri',
                    'description' => 'Project id',
                    'required' => true
                ),
                'todoId' => array(
                    'location' => 'uri',
                    'description' => 'Todo id',
                    'required' => true
                ),
                "content" => array(
                    "location" => "json",
                    "type" => "string",
                    'required' => true,
                ),
                "attachments" => array(
                    "location" => "json",
                    "type" => "array",
                    "required" => false,
                ),
            )
        ),
        'getAttachmentsByProject' => array(
            'httpMethod' => 'GET',
            'uri' => 'projects/{projectId}/attachments.json',
            'parameters' => array(
                'projectId' => array(
                    'location' => 'uri',
                    'description' => 'Project id',
                    'required' => true
                )
            )
        ),
        'createAttachment' => array(
            'httpMethod' => 'POST',
            'uri' => 'attachments.json',
            'parameters' => array(
                'mimeType' => array(
                    'location'    => 'header',
                    'sentAs'      => 'Content-Type',
                    'description' => 'The content type of the data',
                    'required'    => true
                ),
                'data' => array(
                    'location'    => 'body',
                    'description' => 'The attachment\'s binary data',
                    'required'    => true,
                ),
            )
        ),
        'getTodolist' => array(
            'httpMethod' => 'GET',
            'uri' => 'projects/{projectId}/todolists/{todolistId}.json',
            'parameters' => array(
                'projectId' => array(
                    'location' => 'uri',
                    'description' => 'Project id',
                    'required' => true
                ),
                'todolistId' => array(
                    'location' => 'uri',
                    'description' => 'Todolist id',
                    'required' => true
                )
            )
        ),
        'getTodo' => array(
            'httpMethod' => 'GET',
            'uri' => 'projects/{projectId}/todos/{todoId}.json',
            'parameters' => array(
                'projectId' => array(
                    'location' => 'uri',
                    'description' => 'Project id',
                    'required' => true
                ),
                'todoId' => array(
                    'location' => 'uri',
                    'description' => 'Todo id',
                    'required' => true
                )
            )
        ),
        'getCurrentUser' => array(
            'httpMethod' => 'GET',
            'uri' => 'people/me.json',
        ),
        'getGlobalEvents' => array(
            'httpMethod' => 'GET',
            'uri' => 'events.json',
            'summary' => 'Get all global events',
            'parameters' => array(
                'since' => array(
                    'location' => 'query',
                    'description' => 'All events since given datetime (format: 2012-03-24T11:00:00-06:00)',
                    'required' => false
                )
            )
        ),
        'getProjectEvents' => array(
            'httpMethod' => 'GET',
            'uri' => 'projects/{projectId}/events.json',
            'summary' => 'Get all the events on the given project',
            'parameters' => array(
                'projectId' => array(
                    'location' => 'uri',
                    'description' => 'Project id',
                    'required' => true
                ),
                'since' => array(
                    'location' => 'query',
                    'description' => 'All events since given datetime (format: 2012-03-24T11:00:00-06:00)',
                    'required' => false
                )
            )
        ),
        'getAccessesByProject' => array(
            'httpMethod' => 'GET',
            'uri' => 'projects/{projectId}/accesses.json',
            'summary' => 'Will return all the people with access to the project',
            'parameters' => array(
                'projectId' => array(
                    'location' => 'uri',
                    'description' => 'Project id',
                    'required' => true
                )
            )
        ),
        'getAccessesByCalendar' => array(
            'httpMethod' => 'GET',
            'uri' => 'calendars/{calendarId}/accesses.json',
            'summary' => 'Will return all the people with access to the calendar',
            'parameters' => array(
                'calendarId' => array(
                    'location' => 'uri',
                    'description' => 'Calendar id',
                    'required' => true
                )
            )
        ),
        'getPeople' => array(
            'httpMethod' => 'GET',
            'uri'       => 'people.json',
            'summary'   => 'Get all people on the account'
        )
    )
);

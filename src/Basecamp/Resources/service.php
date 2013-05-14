<?php

return array(
    'serviceFullName'       => '37signals Basecamp API',
    'serviceAbbreviation'   => 'Basecamp API',
    'operations'            => array(
        'GetProjects' => array(
            'httpMethod' => 'GET',
            'uri'       => 'projects.json',
            'summary'   => 'Get all active projects'
        ),
        'GetProject' => array(
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
        'GetDocumentsByProject' => array(
            'httpMethod' => 'GET',
            'uri' => 'projects/{id}/documents.json',
            'parameters' => array(
                'id' => array(
                    'location' => 'uri',
                    'description' => 'Retrieve documents for given project',
                    'required' => true
                )
            )
        ),
        'GetDocument' => array(
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
        'GetTopicsByProject' => array(
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
        'GetTodolistsByProject' => array(
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
        'GetCompletedTodolistsByProject' => array(
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
        'CreateTodolistByProject' => array(
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
        'CreateTodoByTodolist' => array(
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
        'CreateCommentByTodo' => array(
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
        'GetAttachmentsByProject' => array(
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
        'CreateAttachment' => array(
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
        'GetTodolist' => array(
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
        'GetCurrentUser' => array(
            'httpMethod' => 'GET',
            'uri' => 'people/me.json',
        ),
        'GetGlobalEvents' => array(
            'httpMethod' => 'GET',
            'uri'       => 'events.json',
            'summary'   => 'Get all global events',
            'parameters' => array(
                'since' => array(
                    'location' => 'query',
                    'description' => 'All events since given datetime (format: 2012-03-24T11:00:00-06:00)',
                    'required' => false
                )
            )
        ),
    )
);

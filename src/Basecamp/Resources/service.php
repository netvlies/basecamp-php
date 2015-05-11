<?php

return array(
    'serviceFullName'       => '37signals Basecamp API',
    'serviceAbbreviation'   => 'Basecamp API',
    'operations'            => array(
        'getArchivedProjects' => array(
            'httpMethod' => 'GET',
            'uri'       => 'projects/archived.json',
            'summary'   => 'Get archived Projects' . PHP_EOL . '[Basecamp API: Projects](https://github.com/basecamp/bcx-api/blob/master/sections/projects.md)',
        ),
        'getProjects' => array(
            'httpMethod' => 'GET',
            'uri'       => 'projects.json',
            'summary'   => 'Get active Projects' . PHP_EOL . '[Basecamp API: Projects](https://github.com/basecamp/bcx-api/blob/master/sections/projects.md)',
        ),
        'getProject' => array(
            'httpMethod' => 'GET',
            'uri'        => 'projects/{id}.json',
            'summary'   => 'Get a Project' . PHP_EOL . '[Basecamp API: Projects](https://github.com/basecamp/bcx-api/blob/master/sections/projects.md)',
            'parameters' => array(
                'id' => array(
                    'location' => 'uri',
                    'description' => 'Project ID',
                    'type' => 'integer',
                    'required' => true,
                )
            )
        ),
        'getDocumentsByProject' => array(
            'httpMethod' => 'GET',
            'uri' => 'projects/{id}/documents.json',
            'summary'   => 'Get all Documents' . PHP_EOL . '[Basecamp API: Documents](https://github.com/basecamp/bcx-api/blob/master/sections/documents.md)',
            'parameters' => array(
                'projectId' => array(
                    'location' => 'uri',
                    'description' => 'Project ID',
                    'type' => 'integer',
                    'required' => true,
                )
            )
        ),
        'getDocument' => array(
            'httpMethod' => 'GET',
            'uri' => 'projects/{projectId}/documents/{documentId}.json',
            'summary'   => 'Get a Document' . PHP_EOL . '[Basecamp API: Documents](https://github.com/basecamp/bcx-api/blob/master/sections/documents.md)',
            'parameters' => array(
                'projectId' => array(
                    'location' => 'uri',
                    'description' => 'Project ID',
                    'type' => 'integer',
                    'required' => true,
                ),
                'documentId' => array(
                    'location' => 'uri',
                    'description' => 'Document ID',
                    'type' => 'integer',
                    'required' => true,
                )
            )
        ),
        'getTopicsByProject' => array(
            'httpMethod' => 'GET',
            'uri' => 'projects/{projectId}/topics.json',
            'summary'   => 'Get Topics' . PHP_EOL . '[Basecamp API: Topics](https://github.com/basecamp/bcx-api/blob/master/sections/topics.md)',
            'parameters' => array(
                'projectId' => array(
                    'location' => 'uri',
                    'description' => 'Project ID',
                    'type' => 'integer',
                    'required' => true,
                )
            )
        ),
        'getTodolistsByProject' => array(
            'httpMethod' => 'GET',
            'uri' => 'projects/{projectId}/todolists.json',
            'summary' => 'Get Todo Lists' . PHP_EOL . '[Basecamp API: Todo lists](https://github.com/basecamp/bcx-api/blob/master/sections/todolists.md)',
            'parameters' => array(
                'projectId' => array(
                    'location' => 'uri',
                    'description' => 'Project ID',
                    'type' => 'integer',
                    'required' => true,
                )
            )
        ),
        'getAssignedTodolistsByPerson' => array(
            'httpMethod' => 'GET',
            'uri' => 'people/{personId}/assigned_todos.json',
            'summary'   => 'Get Todo Lists assigned to a Person' . PHP_EOL . '[Basecamp API: Todo lists](https://github.com/basecamp/bcx-api/blob/master/sections/todolists.md)',
            'parameters' => array(
                'personId' => array(
                    'location' => 'uri',
                    'description' => 'Person id',
                    'type' => 'integer',
                    'required' => true,
                ),
                'page' => array(
                    'location' => 'query',
                    'description' => 'The page to retrieve. API returns 50 todos per page.',
                    'type' => 'integer',
                    'required' => false,
                ),
                'due_since' => array(
                    'location' => 'query',
                    'description' => 'Will return all the to-do lists with to-dos assigned to the specified person due after the date specified. (format: 2012-03-24T11:00:00-06:00)',
                    'type' => 'string',
                    'required' => false,
                )
            )
        ),
        'getCompletedTodolistsByProject' => array(
            'httpMethod' => 'GET',
            'uri' => 'projects/{projectId}/todolists/completed.json',
            'summary'   => 'Get completed Todo Lists' . PHP_EOL . '[Basecamp API: Todo lists](https://github.com/basecamp/bcx-api/blob/master/sections/todolists.md)',
            'parameters' => array(
                'projectId' => array(
                    'location' => 'uri',
                    'description' => 'Project id',
                    'type' => 'integer',
                    'required' => true,
                )
            )
        ),
        'createTodolistByProject' => array(
            'httpMethod' => 'POST',
            'uri' => 'projects/{projectId}/todolists.json',
            'summary'   => 'Create Todo List' . PHP_EOL . '[Basecamp API: Todo lists](https://github.com/basecamp/bcx-api/blob/master/sections/todolists.md)',
            'parameters' => array(
                'projectId' => array(
                    'location' => 'uri',
                    'description' => 'Project id',
                    'type' => 'integer',
                    'required' => true,
                ),
                'name' => array(
                    'location' => 'json',
                    'type' => 'string',
                    'required' => true,
                ),
                'description' => array(
                    'location' => 'json',
                    'type' => 'string',
                    'required' => true,
                )
            )
        ),
        'createTodoByTodolist' => array(
            'httpMethod' => 'POST',
            'uri' => 'projects/{projectId}/todolists/{todolistId}/todos.json',
            'summary'   => 'Create Todo' . PHP_EOL . '[Basecamp API: Todos](https://github.com/basecamp/bcx-api/blob/master/sections/todos.md)',
            'parameters' => array(
                'projectId' => array(
                    'location' => 'uri',
                    'description' => 'Project id',
                    'type' => 'integer',
                    'required' => true,
                ),
                'todolistId' => array(
                    'location' => 'uri',
                    'description' => 'Todo list id',
                    'type' => 'integer',
                    'required' => true,
                ),
                'content' => array(
                    'location' => 'json',
                    'type' => 'string',
                    'required' => true,
                ),
                'assignee' => array(
                    'location' => 'json',
                    'type' => array( 'array', 'object' ),
                    'required' => false,
                ),
            )
        ),
        'createCommentByTodo' => array(
            'httpMethod' => 'POST',
            'uri' => 'projects/{projectId}/todos/{todoId}/comments.json',
            'summary'   => 'Create Comment on Todo' . PHP_EOL . '[Basecamp API: Comments](https://github.com/basecamp/bcx-api/blob/master/sections/comments.md)',
            'parameters' => array(
                'projectId' => array(
                    'location' => 'uri',
                    'description' => 'Project id',
                    'type' => 'integer',
                    'required' => true,
                ),
                'todoId' => array(
                    'location' => 'uri',
                    'description' => 'Todo id',
                    'type' => 'integer',
                    'required' => true,
                ),
                'content' => array(
                    'location' => 'json',
                    'type' => 'string',
                    'required' => true,
                ),
                'attachments' => array(
                    'location' => 'json',
                    'type' => 'array',
                    'required' => false,
                ),
            )
        ),
        'getAttachmentsByProject' => array(
            'httpMethod' => 'GET',
            'uri' => 'projects/{projectId}/attachments.json',
            'summary'   => 'Get Attachments' . PHP_EOL . '[Basecamp API: Attachments](https://github.com/basecamp/bcx-api/blob/master/sections/attachments.md)',
            'parameters' => array(
                'projectId' => array(
                    'location' => 'uri',
                    'description' => 'Project id',
                    'type' => 'integer',
                    'required' => true,
                )
            )
        ),
        'createAttachment' => array(
            'httpMethod' => 'POST',
            'uri' => 'attachments.json',
            'summary'   => 'Create Attachment' . PHP_EOL . '[Basecamp API: Attachments](https://github.com/basecamp/bcx-api/blob/master/sections/attachments.md)',
            'parameters' => array(
                'mimeType' => array(
                    'location'    => 'header',
                    'sentAs'      => 'Content-Type',
                    'description' => 'The content type of the data',
                    'type'        => 'string',
                    'required'    => true,
                ),
                'data' => array(
                    'location'    => 'body',
                    'description' => 'The attachment\'s binary data',
                    'type'        => 'any',
                    'required'    => true,
                ),
            )
        ),
        'getTodolist' => array(
            'httpMethod' => 'GET',
            'uri' => 'projects/{projectId}/todolists/{todolistId}.json',
            'summary'   => 'Get Todo List' . PHP_EOL . '[Basecamp API: Todo lists](https://github.com/basecamp/bcx-api/blob/master/sections/todolists.md)',
            'parameters' => array(
                'projectId' => array(
                    'location' => 'uri',
                    'description' => 'Project id',
                    'type' => 'integer',
                    'required' => true,
                ),
                'todolistId' => array(
                    'location' => 'uri',
                    'description' => 'Todolist id',
                    'type' => 'integer',
                    'required' => true,
                )
            )
        ),
        'getTodo' => array(
            'httpMethod' => 'GET',
            'uri' => 'projects/{projectId}/todos/{todoId}.json',
            'summary'   => 'Get Todo' . PHP_EOL . '[Basecamp API: Todos](https://github.com/basecamp/bcx-api/blob/master/sections/todos.md)',
            'parameters' => array(
                'projectId' => array(
                    'location' => 'uri',
                    'description' => 'Project id',
                    'type' => 'integer',
                    'required' => true,
                ),
                'todoId' => array(
                    'location' => 'uri',
                    'description' => 'Todo id',
                    'type' => 'integer',
                    'required' => true,
                )
            )
        ),
        'updateTodo' => array(
            'httpMethod' => 'PUT',
            'uri' => 'projects/{projectId}/todos/{todoId}.json',
            'summary'   => 'Update Todo' . PHP_EOL . '[Basecamp API: Todos](https://github.com/basecamp/bcx-api/blob/master/sections/todos.md)',
            'parameters' => array(
                'projectId' => array(
                    'location' => 'uri',
                    'description' => 'Project id',
                    'type' => 'integer',
                    'required' => true,
                ),
                'todoId' => array(
                    'location' => 'uri',
                    'description' => 'Todo id',
                    'type' => 'integer',
                    'required' => true,
                ),
                'content' => array(
                    'location' => 'json',
                    'type' => 'string',
                    'required' => false,
                ),
                'due_at' => array(
                    'location' => 'json',
                    'type' => 'string',
                    'required' => false,
                ),
                'assignee' => array(
                    'location' => 'json',
                    'type' => array( 'array', 'object' ),
                    'required' => false,
                ),
                'completed' => array(
                    'location' => 'json',
                    'type' => 'string',
                    'required' => false,
                ),
            )
        ),
        'getCurrentUser' => array(
            'httpMethod' => 'GET',
            'uri' => 'people/me.json',
            'summary'   => 'Get current User' . PHP_EOL . '[Basecamp API: People](https://github.com/basecamp/bcx-api/blob/master/sections/people.md)',
        ),
        'getGlobalEvents' => array(
            'httpMethod' => 'GET',
            'uri' => 'events.json',
            'summary' => 'Get global Events' . PHP_EOL . '[Basecamp API: Events](https://github.com/basecamp/bcx-api/blob/master/sections/events.md)',
            'parameters' => array(
                'since' => array(
                    'location' => 'query',
                    'description' => 'All events since given datetime (format: 2012-03-24T11:00:00-06:00)',
                    'type' => 'string',
                    'required' => false,
                ),
                'page' => array(
                    'location' => 'query',
                    'description' => 'The page to retrieve. API returns 50 events per page.',
                    'type' => 'integer',
                    'required' => false,
                )
            )
        ),
        'getProjectEvents' => array(
            'httpMethod' => 'GET',
            'uri' => 'projects/{projectId}/events.json',
            'summary' => 'Get Project Events' . PHP_EOL . '[Basecamp API: Events](https://github.com/basecamp/bcx-api/blob/master/sections/events.md)',
            'parameters' => array(
                'projectId' => array(
                    'location' => 'uri',
                    'description' => 'Project id',
                    'type' => 'integer',
                    'required' => true,
                ),
                'since' => array(
                    'location' => 'query',
                    'description' => 'All events since given datetime (format: 2012-03-24T11:00:00-06:00)',
                    'type' => 'string',
                    'required' => false,
                )
            )
        ),
        'getAccessesByProject' => array(
            'httpMethod' => 'GET',
            'uri' => 'projects/{projectId}/accesses.json',
            'summary' => 'Get Accesses to Project' . PHP_EOL . '[Basecamp API: Accesses](https://github.com/basecamp/bcx-api/blob/master/sections/accesses.md)',
            'parameters' => array(
                'projectId' => array(
                    'location' => 'uri',
                    'description' => 'Project id',
                    'type' => 'integer',
                    'required' => true,
                )
            )
        ),
        'getAccessesByCalendar' => array(
            'httpMethod' => 'GET',
            'uri' => 'calendars/{calendarId}/accesses.json',
            'summary' => 'Get Accesses to Calendar' . PHP_EOL . '[Basecamp API: Accesses](https://github.com/basecamp/bcx-api/blob/master/sections/accesses.md)',
            'parameters' => array(
                'calendarId' => array(
                    'location' => 'uri',
                    'description' => 'Calendar id',
                    'type' => 'integer',
                    'required' => true,
                )
            )
        ),
        'getPeople' => array(
            'httpMethod' => 'GET',
            'uri'       => 'people.json',
            'summary'   => 'Get all People' . PHP_EOL . '[Basecamp API: People](https://github.com/basecamp/bcx-api/blob/master/sections/people.md)'
        ),
        'getGroups' => array(
            'httpMethod' => 'GET',
            'uri'       => 'groups.json',
            'summary'   => 'Get all Groups' . PHP_EOL . '[Basecamp API: People](https://github.com/basecamp/bcx-api/blob/master/sections/groups.md)'
        )
    )
);

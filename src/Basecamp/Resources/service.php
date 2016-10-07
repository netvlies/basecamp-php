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
            'uri' => 'projects/{projectId}/documents.json',
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
        'getCompletedTodosByProject' => array(
            'httpMethod' => 'GET',
            'uri' => 'projects/{projectId}/todos/completed.json',
            'summary' => 'Get completed Todos' . PHP_EOL . '[Basecamp API: Todos](https://github.com/basecamp/bcx-api/blob/master/sections/todos.md)',
            'parameters' => array(
                'projectId' => array(
                    'location' => 'uri',
                    'description' => 'Project id',
                    'type' => 'integer',
                    'required' => true,
                )
            )
        ),
        'createProject' => array(
            'httpMethod' => 'POST',
            'uri' => 'projects.json',
            'summary' => 'Create a new project' . PHP_EOL . '[Basecamp API: Projects](https://github.com/basecamp/bcx-api/blob/master/sections/projects.md)',
            'parameters' => array(
                'name' => array(
                    'location' => 'json',
                    'type' => 'string',
                    'required' => true
                ),
                'description' => array(
                    'location' => 'json',
                    'type' => 'string',
                    'required' => true
                )
            )
        ),
        'createDocument' => array(
            'httpMethod' => 'POST',
            'uri' => 'projects/{projectId}/documents.json',
            'summary' => 'Create a new document' . PHP_EOL . '[Basecamp API: Documents](https://github.com/basecamp/bcx-api/blob/master/sections/documents.md)',
            'parameters' => array(
                'projectId' => array(
                    'location' => 'uri',
                    'description' => 'Project ID',
                    'type' => 'integer',
                    'required' => true
                ),
                'title' => array(
                    'location' => 'json',
                    'type' => 'string',
                    'required' => true
                ),
                'content' => array(
                    'location' => 'json',
                    'type' => 'string',
                    'required' => true
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
        'getSpecificUser' => array(
            'httpMethod' => 'GET',
            'uri' => 'people/{personId}.json',
            'summary'   => 'Get specific User' . PHP_EOL . '[Basecamp API: People](https://github.com/basecamp/bcx-api/blob/master/sections/people.md)',
            'parameters' => array(
                'personId' => array(
                    'location' => 'uri',
                    'description' => 'Person id',
                    'type' => 'integer',
                    'required' => true,
                )
            )
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
        ),
        'grantAccess' => array(
            'httpMethod' => 'POST',
            'uri' => 'projects/{projectId}/accesses.json',
            'summary' => 'Grant access' . PHP_EOL . '[Basecamp API: Access](https://github.com/basecamp/bcx-api/blob/master/sections/accesses.md)',
            'parameters' => array(
                'projectId' => array(
                    'location' => 'uri',
                    'description' => 'Project id',
                    'type' => 'integer',
                    'required' => true
                ),
                'ids' => array(
                    'location' => 'json',
                    'description' => 'Existing user ids',
                    'type' => 'array',
                    'required' => true
                ),
                'email_addresses' => array(
                    'location' => 'json',
                    'description' => 'Grant access to new users',
                    'type' => 'string',
                    'required' => false
                )
            )
        ),
        'getCalendars' => array(
            'httpMethod' => 'GET',
            'uri' => 'calendars.json',
            'summary' => 'Get all Calendars' . PHP_EOL . '[Basecamp API: Calendars](https://github.com/basecamp/bcx-api/blob/master/sections/calendars.md)'
        ),
        'getCalendar' => array(
            'httpMethod' => 'GET',
            'uri' => 'calendars/{calendarId}.json',
            'summary' => 'Get single Calendar' . PHP_EOL . '[Basecamp API: Calendars](https://github.com/basecamp/bcx-api/blob/master/sections/calendars.md)',
            'parameters' => array(
                'calendarId' => array(
                    'location' => 'uri',
                    'description' => 'Calendar id',
                    'type' => 'integer',
                    'required' => true,
                )
            )
        ),
        'createCalendar' => array(
            'httpMethod' => 'POST',
            'uri' => 'calendars.json',
            'summary' => 'Create new Calendar' . PHP_EOL . '[Basecamp API: Calendars](https://github.com/basecamp/bcx-api/blob/master/sections/calendars.md)',
            'parameters' => array(
                'name' => array(
                    'location' => 'json',
                    'type' => 'string',
                    'required' => true
                )
            )
        ),
        'updateCalendar' => array(
            'httpMethod' => 'PUT',
            'uri' => 'calendars/{calendarId}.json',
            'summary' => 'Update Calendar' . PHP_EOL . '[Basecamp API: Calendars](https://github.com/basecamp/bcx-api/blob/master/sections/calendars.md)',
            'parameters' => array(
                'calendarId' => array(
                    'location' => 'uri',
                    'description' => 'Calendar id',
                    'type' => 'integer',
                    'required' => true,
                ),
                'name' => array(
                    'location' => 'json',
                    'type' => 'string',
                    'required' => true
                )
            )
        ),
        'deleteCalendar' => array(
            'httpMethod' => 'DELETE',
            'uri' => 'calendars/{calendarId}.json',
            'summary' => 'Delete Calendar' . PHP_EOL . '[Basecamp API: Calendars](https://github.com/basecamp/bcx-api/blob/master/sections/calendars.md)',
            'parameters' => array(
                'calendarId' => array(
                    'location' => 'uri',
                    'description' => 'Calendar id',
                    'type' => 'integer',
                    'required' => true,
                )
            )
        ),
        'getAllCalendarEvents' => array(
            'httpMethod' => 'GET',
            'uri' => 'calendar_events.json',
            'summary' => 'Get all events' . PHP_EOL . '[Basecamp API: Calendar Events](https://github.com/basecamp/bcx-api/blob/master/sections/calendar_events.md)',
            'parameters' => array(
                'start_date' => array(
                    'location' => 'query',
                    'description' => 'Will return 6 weeks worth of events after the start date if the end date is not supplied (format: 2015-09-15)',
                    'type' => 'string'
                ),
                'end_date' => array(
                    'location' => 'query',
                    'description' => 'Will return 6 weeks worth of events after the start date if the end date is not supplied (format: 2015-09-15)',
                    'type' => 'string'
                )
            )
        ),
        'getCalendarEvents' => array(
            'httpMethod' => 'GET',
            'uri' => 'calendars/{calendarId}/calendar_events.json',
            'summary' => 'Get upcoming calendar events' . PHP_EOL . '[Basecamp API: Calendar Events](https://github.com/basecamp/bcx-api/blob/master/sections/calendar_events.md)',
            'parameters' => array(
                'calendarId' => array(
                    'location' => 'uri',
                    'description' => 'Calendar id',
                    'type' => 'integer',
                    'required' => true,
                ),
                'start_date' => array(
                    'location' => 'query',
                    'description' => 'Will return 6 weeks worth of events after the start date if the end date is not supplied (format: 2015-09-15)',
                    'type' => 'string'
                ),
                'end_date' => array(
                    'location' => 'query',
                    'description' => 'Will return 6 weeks worth of events after the start date if the end date is not supplied (format: 2015-09-15)',
                    'type' => 'string'
                )
            )
        ),
        'getCalendarEventsPast' => array(
            'httpMethod' => 'GET',
            'uri' => 'calendars/{calendarId}/calendar_events/past.json',
            'summary' => 'Get past calendar events' . PHP_EOL . '[Basecamp API: Calendar Events](https://github.com/basecamp/bcx-api/blob/master/sections/calendar_events.md)',
            'parameters' => array(
                'calendarId' => array(
                    'location' => 'uri',
                    'description' => 'Calendar id',
                    'type' => 'integer',
                    'required' => true,
                )
            )
        ),
        'getCalendarEvent' => array(
            'httpMethod' => 'GET',
            'uri' => 'calendars/{calendarId}/calendar_events/{eventId}.json',
            'summary' => 'Get single calendar event' . PHP_EOL . '[Basecamp API: Calendar Events](https://github.com/basecamp/bcx-api/blob/master/sections/calendar_events.md)',
            'parameters' => array(
                'calendarId' => array(
                    'location' => 'uri',
                    'description' => 'Calendar id',
                    'type' => 'integer',
                    'required' => true,
                ),
                'eventId' => array(
                    'location' => 'uri',
                    'description' => 'Event id',
                    'type' => 'integer',
                    'required' => true,
                )
            )
        ),
        'createCalendarEvent' => array(
            'httpMethod' => 'POST',
            'uri' => 'calendars/{calendarId}/calendar_events.json',
            'summary' => 'Create calendar event' . PHP_EOL . '[Basecamp API: Calendar Events](https://github.com/basecamp/bcx-api/blob/master/sections/calendar_events.md)',
            'parameters' => array(
                'calendarId' => array(
                    'location' => 'uri',
                    'description' => 'Calendar id',
                    'type' => 'integer',
                    'required' => true,
                ),
                'summary' => array(
                    'location' => 'json',
                    'description' => 'Event Summary / title',
                    'type' => 'string',
                    'required' => true
                ),
                'description' => array(
                    'location' => 'json',
                    'description' => 'Event Description',
                    'type' => 'string'
                ),
                'starts_at' => array(
                    'location' => 'json',
                    'description' => 'Date (and time if not an all day event) that the event starts at (format: 2015-09-15 or 2015-09-15T11:50:00-05:00)',
                    'type' => 'string',
                    'required' => true
                ),
                'ends_at' => array(
                    'location' => 'json',
                    'description' => 'Date (and time if not an all day event) that the event ends at (format: 2015-09-15 or 2015-09-15T11:50:00-05:00)',
                    'type' => 'string'
                ),
                'remind_at' => array(
                    'location' => 'json',
                    'description' => 'Datetime to remind subscribers about the event via email (format: 2015-09-15T11:50:00-05:00)',
                    'type' => 'string'
                ),
                'subscribers' => array(
                    'location' => 'json',
                    'description' => 'Array of user id\'s to subscribe to the event.',
                    'type' => 'array'
                ),
                'recurring' => array(
                    'location' => 'json',
                    'description' => 'Array of recurring parrameters - starts_at, frequency, count, until, excluding',
                    'type' => 'array'
                ),
                'all_day' => array(
                    'location' => 'json',
                    'description' => 'Is the event a full day event?',
                    'type' => 'boolean'
                )
            )
        ),
        'updateCalendarEvent' => array(
            'httpMethod' => 'PUT',
            'uri' => 'calendars/{calendarId}/calendar_events/{eventId}.json',
            'summary' => 'Update a calendar event' . PHP_EOL . '[Basecamp API: Calendar Events](https://github.com/basecamp/bcx-api/blob/master/sections/calendar_events.md)',
            'parameters' => array(
                'calendarId' => array(
                    'location' => 'uri',
                    'description' => 'Calendar id',
                    'type' => 'integer',
                    'required' => true,
                ),
                'eventId' => array(
                    'location' => 'uri',
                    'description' => 'Event id',
                    'type' => 'integer',
                    'required' => true,
                ),
                'summary' => array(
                    'location' => 'json',
                    'description' => 'Event Summary / title',
                    'type' => 'string'
                ),
                'description' => array(
                    'location' => 'json',
                    'description' => 'Event Description',
                    'type' => 'string'
                ),
                'starts_at' => array(
                    'location' => 'json',
                    'description' => 'Date (and time if not an all day event) that the event starts at (format: 2015-09-15 or 2015-09-15T11:50:00-05:00)',
                    'type' => 'string'
                ),
                'ends_at' => array(
                    'location' => 'json',
                    'description' => 'Date (and time if not an all day event) that the event ends at (format: 2015-09-15 or 2015-09-15T11:50:00-05:00)',
                    'type' => 'string'
                ),
                'remind_at' => array(
                    'location' => 'json',
                    'description' => 'Datetime to remind subscribers about the event via email (format: 2015-09-15T11:50:00-05:00)',
                    'type' => 'string'
                ),
                'subscribers' => array(
                    'location' => 'json',
                    'description' => 'Array of user id\'s to subscribe to the event.',
                    'type' => 'array'
                ),
                'recurring' => array(
                    'location' => 'json',
                    'description' => 'Array of recurring parrameters - starts_at, frequency, count, until, excluding',
                    'type' => 'array'
                ),
                'all_day' => array(
                    'location' => 'json',
                    'description' => 'Is the event a full day event?',
                    'type' => 'boolean'
                )
            )
        ),
        'deleteCalendarEvent' => array(
            'httpMethod' => 'DELETE',
            'uri' => 'calendars/{calendarId}/calendar_events/{eventId}.json',
            'summary' => 'Delete a calendar event' . PHP_EOL . '[Basecamp API: Calendar Events](https://github.com/basecamp/bcx-api/blob/master/sections/calendar_events.md)',
            'parameters' => array(
                'calendarId' => array(
                    'location' => 'uri',
                    'description' => 'Calendar id',
                    'type' => 'integer',
                    'required' => true,
                ),
                'eventId' => array(
                    'location' => 'uri',
                    'description' => 'Event id',
                    'type' => 'integer',
                    'required' => true,
                )
            )
        ),
        'getProjectCalendarEvents' => array(
            'httpMethod' => 'GET',
            'uri' => 'projects/{projectId}/calendar_events.json',
            'summary' => 'Get upcoming project calendar events' . PHP_EOL . '[Basecamp API: Calendar Events](https://github.com/basecamp/bcx-api/blob/master/sections/calendar_events.md)',
            'parameters' => array(
                'projectId' => array(
                    'location' => 'uri',
                    'description' => 'Project ID',
                    'type' => 'integer',
                    'required' => true,
                ),
                'start_date' => array(
                    'location' => 'query',
                    'description' => 'Will return 6 weeks worth of events after the start date if the end date is not supplied (format: 2015-09-15)',
                    'type' => 'string'
                ),
                'end_date' => array(
                    'location' => 'query',
                    'description' => 'Will return 6 weeks worth of events after the start date if the end date is not supplied (format: 2015-09-15)',
                    'type' => 'string'
                )
            )
        ),
        'getProjectCalendarEventsPast' => array(
            'httpMethod' => 'GET',
            'uri' => 'projects/{projectId}/calendar_events/past.json',
            'summary' => 'Get past project calendar events' . PHP_EOL . '[Basecamp API: Calendar Events](https://github.com/basecamp/bcx-api/blob/master/sections/calendar_events.md)',
            'parameters' => array(
                'projectId' => array(
                    'location' => 'uri',
                    'description' => 'Project ID',
                    'type' => 'integer',
                    'required' => true,
                )
            )
        ),
        'getProjectCalendarEvent' => array(
            'httpMethod' => 'GET',
            'uri' => 'projects/{projectId}/calendar_events/{eventId}.json',
            'summary' => 'Get single project calendar event' . PHP_EOL . '[Basecamp API: Calendar Events](https://github.com/basecamp/bcx-api/blob/master/sections/calendar_events.md)',
            'parameters' => array(
                'projectId' => array(
                    'location' => 'uri',
                    'description' => 'Project id',
                    'type' => 'integer',
                    'required' => true,
                ),
                'eventId' => array(
                    'location' => 'uri',
                    'description' => 'Event id',
                    'type' => 'integer',
                    'required' => true,
                )
            )
        ),
        'createProjectCalendarEvent' => array(
            'httpMethod' => 'POST',
            'uri' => 'projects/{projectId}/calendar_events.json',
            'summary' => 'Create project calendar event' . PHP_EOL . '[Basecamp API: Calendar Events](https://github.com/basecamp/bcx-api/blob/master/sections/calendar_events.md)',
            'parameters' => array(
                'projectId' => array(
                    'location' => 'uri',
                    'description' => 'Project id',
                    'type' => 'integer',
                    'required' => true,
                ),
                'summary' => array(
                    'location' => 'json',
                    'description' => 'Event Summary / title',
                    'type' => 'string',
                    'required' => true
                ),
                'description' => array(
                    'location' => 'json',
                    'description' => 'Event Description',
                    'type' => 'string'
                ),
                'starts_at' => array(
                    'location' => 'json',
                    'description' => 'Date (and time if not an all day event) that the event starts at (format: 2015-09-15 or 2015-09-15T11:50:00-05:00)',
                    'type' => 'string',
                    'required' => true
                ),
                'ends_at' => array(
                    'location' => 'json',
                    'description' => 'Date (and time if not an all day event) that the event ends at (format: 2015-09-15 or 2015-09-15T11:50:00-05:00)',
                    'type' => 'string'
                ),
                'remind_at' => array(
                    'location' => 'json',
                    'description' => 'Datetime to remind subscribers about the event via email (format: 2015-09-15T11:50:00-05:00)',
                    'type' => 'string'
                ),
                'subscribers' => array(
                    'location' => 'json',
                    'description' => 'Array of user id\'s to subscribe to the event.',
                    'type' => 'array'
                ),
                'recurring' => array(
                    'location' => 'json',
                    'description' => 'Array of recurring parrameters - starts_at, frequency, count, until, excluding',
                    'type' => 'array'
                ),
                'all_day' => array(
                    'location' => 'json',
                    'description' => 'Is the event a full day event?',
                    'type' => 'boolean'
                )
            )
        ),
        'updateProjectCalendarEvent' => array(
            'httpMethod' => 'PUT',
            'uri' => 'projects/{projectId}/calendar_events/{eventId}.json',
            'summary' => 'Update a project calendar event' . PHP_EOL . '[Basecamp API: Calendar Events](https://github.com/basecamp/bcx-api/blob/master/sections/calendar_events.md)',
            'parameters' => array(
                'projectId' => array(
                    'location' => 'uri',
                    'description' => 'Project id',
                    'type' => 'integer',
                    'required' => true,
                ),
                'eventId' => array(
                    'location' => 'uri',
                    'description' => 'Event id',
                    'type' => 'integer',
                    'required' => true,
                ),
                'summary' => array(
                    'location' => 'json',
                    'description' => 'Event Summary / title',
                    'type' => 'string'
                ),
                'description' => array(
                    'location' => 'json',
                    'description' => 'Event Description',
                    'type' => 'string'
                ),
                'starts_at' => array(
                    'location' => 'json',
                    'description' => 'Date (and time if not an all day event) that the event starts at (format: 2015-09-15 or 2015-09-15T11:50:00-05:00)',
                    'type' => 'string'
                ),
                'ends_at' => array(
                    'location' => 'json',
                    'description' => 'Date (and time if not an all day event) that the event ends at (format: 2015-09-15 or 2015-09-15T11:50:00-05:00)',
                    'type' => 'string'
                ),
                'remind_at' => array(
                    'location' => 'json',
                    'description' => 'Datetime to remind subscribers about the event via email (format: 2015-09-15T11:50:00-05:00)',
                    'type' => 'string'
                ),
                'subscribers' => array(
                    'location' => 'json',
                    'description' => 'Array of user id\'s to subscribe to the event.',
                    'type' => 'array'
                ),
                'recurring' => array(
                    'location' => 'json',
                    'description' => 'Array of recurring parrameters - starts_at, frequency, count, until, excluding',
                    'type' => 'array'
                ),
                'all_day' => array(
                    'location' => 'json',
                    'description' => 'Is the event a full day event?',
                    'type' => 'boolean'
                )
            )
        ),
        'deleteProjectCalendarEvent' => array(
            'httpMethod' => 'DELETE',
            'uri' => 'projects/{projectId}/calendar_events/{eventId}.json',
            'summary' => 'Delete a project calendar event' . PHP_EOL . '[Basecamp API: Calendar Events](https://github.com/basecamp/bcx-api/blob/master/sections/calendar_events.md)',
            'parameters' => array(
                'projectId' => array(
                    'location' => 'uri',
                    'description' => 'Project id',
                    'type' => 'integer',
                    'required' => true,
                ),
                'eventId' => array(
                    'location' => 'uri',
                    'description' => 'Event id',
                    'type' => 'integer',
                    'required' => true,
                )
            )
        )
    )
);

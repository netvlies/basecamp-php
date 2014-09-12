# Basecamp SDK for PHP

[![Build Status](https://secure.travis-ci.org/netvlies/basecamp-php.png)](https://secure.travis-ci.org/netvlies/basecamp-php)

The **Basecamp SDK for PHP** enables PHP developers to easily integrate [37signals Basecamp all new API][basecamp] into their applications.

**NOTE**: This library is under heavy development and a lot of calls haven't been implemented yet. We're looking forward to any of your PR's.

## Installation
We recommend Composer for managing dependencies. Installing is as easy as:

    $ php composer.phar require netvlies/basecamp-php

## Usage

To use the library the only requirement is you have a account.
Upon creating the client you have to pass your credentials or an OAuth token. Furthermore you need your userId to construct the URI's.

### Authorization with username and password

```php
<?php

$client = \Basecamp\BasecampClient::factory(array(
    'auth' => 'http',
    'username' => 'you@email.com',
    'password' => 'secret',
    'user_id' => 99999999,
    'app_name' => 'My Wicked Application',
    'app_contact' => 'http://mywickedapplication.com'
));
```

### Authorization with OAuth token

This library doesn't handle the OAuth authorization process for you. There are already a lot of libraries out there which handle this process perfectly for you. When you recieved your token you'll have to pass it on to the client:

```php
<?php

$client = \Basecamp\BasecampClient::factory(array(
    'auth'     => 'oauth',
    'token'    => 'Wtj4htewhtuewhuoitewh',
    'user_id'   => 99999999,
    'app_name' => 'My Wicked Application',
    'app_contact' => 'http://mywickedapplication.com'
));

```

### Identification

It is required to identify you application. This can be accomplished by using <code>app_name</code> and <code>app_contact</code>.

## About this API client

This client is build upon the shoulders of the impressive [Guzzle library][guzzle]. If you're willing to contribute to this client, make sure
to check out the docs.

## Caching

It is required to implement caching in your application. Lucky for you, using Guzzle this is peanuts! Please refer to the [official docs][caching] for more information.

Here's a quick example using the Doctrine cache:

```php
<?php

use Basecamp\BasecampClient;
use Doctrine\Common\Cache\FilesystemCache;
use Guzzle\Cache\DoctrineCacheAdapter;
use Guzzle\Plugin\Cache\CachePlugin;

$cachePlugin = new CachePlugin(array(
    'adapter' => new DoctrineCacheAdapter(new FilesystemCache(__DIR__.'/../../../../app/cache/basecamp'))
));

$this->client = BasecampClient::factory(array(
    // config options
));
$this->client->addSubscriber($cachePlugin);

```

## API calls

All services are documented below. View full service description in [src/Basecamp/Resources/service.php][service.php]

<!--- START API Generate with: php -f `generate-api-docs.php` -->

### Get archived Projects
[Basecamp API: Projects](https://github.com/basecamp/bcx-api/blob/master/sections/projects.md) 

```php 
$response = $client->getArchivedProjects(); 
``` 

### Get active Projects
[Basecamp API: Projects](https://github.com/basecamp/bcx-api/blob/master/sections/projects.md) 

```php 
$response = $client->getProjects(); 
``` 

### Get a Project
[Basecamp API: Projects](https://github.com/basecamp/bcx-api/blob/master/sections/projects.md) 

```php 
$response = $client->getProject( array( 
	'id' => 1234567,  // Required. Project ID 
) ); 
``` 

### Get all Documents
[Basecamp API: Documents](https://github.com/basecamp/bcx-api/blob/master/sections/documents.md) 

```php 
$response = $client->getDocumentsByProject( array( 
	'projectId' => 1234567,  // Required. Project ID 
) ); 
``` 

### Get a Document
[Basecamp API: Documents](https://github.com/basecamp/bcx-api/blob/master/sections/documents.md) 

```php 
$response = $client->getDocument( array( 
	'projectId' => 1234567,  // Required. Project ID 
	'documentId' => 1234567,  // Required. Document ID 
) ); 
``` 

### Get Topics
[Basecamp API: Topics](https://github.com/basecamp/bcx-api/blob/master/sections/topics.md) 

```php 
$response = $client->getTopicsByProject( array( 
	'projectId' => 1234567,  // Required. Project ID 
) ); 
``` 

### Get Todo Lists
[Basecamp API: Todo lists](https://github.com/basecamp/bcx-api/blob/master/sections/todolists.md) 

```php 
$response = $client->getTodolistsByProject( array( 
	'projectId' => 1234567,  // Required. Project ID 
) ); 
``` 

### Get Todo Lists assigned to a Person
[Basecamp API: Todo lists](https://github.com/basecamp/bcx-api/blob/master/sections/todolists.md) 

```php 
$response = $client->getAssignedTodolistsByPerson( array( 
	'personId' => 1234567,  // Required. Person id 
) ); 
``` 

### Get completed Todo Lists
[Basecamp API: Todo lists](https://github.com/basecamp/bcx-api/blob/master/sections/todolists.md) 

```php 
$response = $client->getCompletedTodolistsByProject( array( 
	'projectId' => 1234567,  // Required. Project id 
) ); 
``` 

### Create Todo List
[Basecamp API: Todo lists](https://github.com/basecamp/bcx-api/blob/master/sections/todolists.md) 

```php 
$response = $client->createTodolistByProject( array( 
	'projectId' => 1234567,  // Required. Project id 
	'name' => 'Example name',  // Required.  
	'description' => 'Example description',  // Required.  
) ); 
``` 

### Create Todo
[Basecamp API: Todos](https://github.com/basecamp/bcx-api/blob/master/sections/todos.md) 

```php 
$response = $client->createTodoByTodolist( array( 
	'projectId' => 1234567,  // Required. Project id 
	'todolistId' => 1234567,  // Required. Todo list id 
	'content' => 'Example content',  // Required.  
	'assignee' => array( 'id' => 1234567, 'type' => 'Person' ),  // Optional.  
) ); 
``` 

### Create Comment on Todo
[Basecamp API: Comments](https://github.com/basecamp/bcx-api/blob/master/sections/comments.md) 

```php 
$response = $client->createCommentByTodo( array( 
	'projectId' => 1234567,  // Required. Project id 
	'todoId' => 1234567,  // Required. Todo id 
	'content' => 'Example content',  // Required.  
	'attachments' => array( array( 'token' => $upload_token, 'name' => 'file.jpg' ) ),  // Optional.  
) ); 
``` 

### Get Attachments
[Basecamp API: Attachments](https://github.com/basecamp/bcx-api/blob/master/sections/attachments.md) 

```php 
$response = $client->getAttachmentsByProject( array( 
	'projectId' => 1234567,  // Required. Project id 
) ); 
``` 

### Create Attachment
[Basecamp API: Attachments](https://github.com/basecamp/bcx-api/blob/master/sections/attachments.md) 

```php 
$response = $client->createAttachment( array( 
	'mimeType' => 'image/jpeg',  // Required. The content type of the data 
	'data' => file_get_contents( 'image.jpg' ),  // Required. The attachment's binary data 
) ); 
``` 

### Get Todo List
[Basecamp API: Todo lists](https://github.com/basecamp/bcx-api/blob/master/sections/todolists.md) 

```php 
$response = $client->getTodolist( array( 
	'projectId' => 1234567,  // Required. Project id 
	'todolistId' => 1234567,  // Required. Todolist id 
) ); 
``` 

### Get Todo
[Basecamp API: Todos](https://github.com/basecamp/bcx-api/blob/master/sections/todos.md) 

```php 
$response = $client->getTodo( array( 
	'projectId' => 1234567,  // Required. Project id 
	'todoId' => 1234567,  // Required. Todo id 
) ); 
``` 

### Update Todo
[Basecamp API: Todos](https://github.com/basecamp/bcx-api/blob/master/sections/todos.md) 

```php 
$response = $client->updateTodo( array( 
	'projectId' => 1234567,  // Required. Project id 
	'todoId' => 1234567,  // Required. Todo id 
	'content' => 'Example content',  // Optional.  
	'due_at' => 'example',  // Optional.  
	'assignee' => array( 'id' => 1234567, 'type' => 'Person' ),  // Optional.  
	'completed' => 'example',  // Optional.  
) ); 
``` 

### Get current User
[Basecamp API: People](https://github.com/basecamp/bcx-api/blob/master/sections/people.md) 

```php 
$response = $client->getCurrentUser(); 
``` 

### Get global Events
[Basecamp API: Events](https://github.com/basecamp/bcx-api/blob/master/sections/events.md) 

```php 
$response = $client->getGlobalEvents( array( 
	'since' => '2012-03-24T11:00:00-06:00',  // Optional. All events since given datetime (format: 2012-03-24T11:00:00-06:00) 
	'page' => 1234567,  // Optional. The page to retrieve. API returns 50 events per page. 
) ); 
``` 

### Get Project Events
[Basecamp API: Events](https://github.com/basecamp/bcx-api/blob/master/sections/events.md) 

```php 
$response = $client->getProjectEvents( array( 
	'projectId' => 1234567,  // Required. Project id 
	'since' => '2012-03-24T11:00:00-06:00',  // Optional. All events since given datetime (format: 2012-03-24T11:00:00-06:00) 
) ); 
``` 

### Get Accesses to Project
[Basecamp API: Accesses](https://github.com/basecamp/bcx-api/blob/master/sections/accesses.md) 

```php 
$response = $client->getAccessesByProject( array( 
	'projectId' => 1234567,  // Required. Project id 
) ); 
``` 

### Get Accesses to Calendar
[Basecamp API: Accesses](https://github.com/basecamp/bcx-api/blob/master/sections/accesses.md) 

```php 
$response = $client->getAccessesByCalendar( array( 
	'calendarId' => 1234567,  // Required. Calendar id 
) ); 
``` 

### Get all People
[Basecamp API: People](https://github.com/basecamp/bcx-api/blob/master/sections/people.md) 

```php 
$response = $client->getPeople(); 
``` 

<!--- END API -->

[basecamp]: https://basecamp.com/
[guzzle]: http://guzzlephp.org/
[caching]: http://guzzlephp.org/plugins/cache-plugin.html
[service.php]: https://github.com/netvlies/basecamp-php/blob/master/src/Basecamp/Resources/service.php
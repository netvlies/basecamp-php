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

$service = \Basecamp\BasecampClient::factory(array(
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

$service = \Basecamp\BasecampClient::factory(array(
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

Currently only a few example calls have been documented. Refer to the service description (<code>src/Basecamp/Resources/service.php</code>) for all the available calls.

### Get a project

```php
<?php

$project = $client->getProject(array(
    'projectId' => 1
));

```

### Get documents

```php
<?php

$documents = $client->getDocumentsByProject(array(
    'projectId' => 1
));

$document = $client->getDocument(array(
    'projectId' => 1,
    'documentId' => 1
));

```

[basecamp]: https://basecamp.com/
[guzzle]: http://guzzlephp.org/
[caching]: http://guzzlephp.org/plugins/cache-plugin.html

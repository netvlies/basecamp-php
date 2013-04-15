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
    'auth'     => 'http',
    'username' => 'you@email.com',
    'password' => 'secret',
    'userId'   => 99999999
));
```

### Authorization with OAuth token

This library doesn't handle the OAuth authorization process for you. There are already a lot of libraries out there which handle this process perfectly for you. When you recieved your token you'll have to pass it on to the client:

```php
<?php

$service = \Basecamp\BasecampClient::factory(array(
    'auth'     => 'oauth',
    'token'    => 'Wtj4htewhtuewhuoitewh',
    'userId'   => 99999999
));

```

### Get a project

```php
<?php

$project = $service->getProject(1);

```

[basecamp]: https://basecamp.com/

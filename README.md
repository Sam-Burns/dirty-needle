[![Build Status](https://travis-ci.org/Sam-Burns/dirty-needle.svg?branch=master)](https://travis-ci.org/Sam-Burns/dirty-needle)
[![Coverage Status](https://coveralls.io/repos/Sam-Burns/dirty-needle/badge.svg?branch=master)](https://coveralls.io/r/Sam-Burns/dirty-needle?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Sam-Burns/dirty-needle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Sam-Burns/dirty-needle/?branch=master)

dirty-needle
============

Introduction
------------

Dependency Injection container for PHP

Set up a config file which returns a PHP array, like this:

```php
<?php
return array(
    'dirty-needle' => array(
        '@dependency' => array(
            'class' => '\Dependency'
        ),
        '@class-with-dependency' => array(
            'class' => '\ClassWithDependency',
            'arguments' => array(
                '@dependency'
            )
        ),
    ),
);
```

Then get stuff out of your container, like this:

```php
$diContainer = \DirtyNeedle\DiContainer()::getInstance();
$diContainer->addConfigFile('/path/to/config.php');
$classWithDependency = $diContainer->get('class-with-dependency');
```

You can also do inject mock objects:
```php
$diContainer->set('service-id', $mockObject);
```

Reseting definitions and mocks:
```php
$diContainer->reset();
```

Releases are available supporting PHP5.3-5.6, with the 5.6-compatible releases being significantly faster in their implementation.

Versioning
----------

The project uses [semantic versioning](http://semver.org/).

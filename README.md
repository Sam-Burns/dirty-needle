[![Build Status](https://travis-ci.org/Sam-Burns/dirty-needle.svg?branch=master)](https://travis-ci.org/Sam-Burns/dirty-needle)

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
        'dependency' => array(
            'class' => '\Dependency'
        ),
        'class-with-dependency' => array(
            'class' => '\ClassWithDependency',
            'arguments' => array(
                'dependency'
            )
        ),
    ),
);
```

Then get stuff out of your container, like this:

```php
$diContainer = new \DirtyNeedle\DiContainer();
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

The project uses [semantic versioning](http://semver.org/).  Additionally to this, even-numbered patch releases support PHP5.4 and 5.5, and odd numbered patch releases support PHP5.6 only.
It is sufficient to add the following to your `composer.json` file:
```json
"require": {
    "Sam-Burns/dirtyneedle": "3.0.*"
}
```
Composer knows which version of PHP you are using and will select a compatible release accordingly.

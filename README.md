[![Build Status](https://travis-ci.org/Sam-Burns/dirty-needle.svg?branch=master)](https://travis-ci.org/Sam-Burns/dirty-needle)

dirty-needle
============

Dependency Injection container for PHP

Set up a config file which returns a PHP array, like this:

```php
<?php
return array(
    'dirty-needle' => array(
        'services' => array(
            'simple-dependency' => array(
                'class' => '\SimpleDependency'
            ),
            'class-with-dependency' => array(
                'class' => '\ClassWithDependency',
                'arguments' => array(
                    'simple-dependency'
                )
            ),
        ),
    ),
);
```

Then get stuff out of your container, like this:

```php
$diContainer = new \DirtyNeedle\DiContainer();
$diContainer->addConfigFile('/path/to/config.php');
var_dump($diContainer->get('class-with-dependency')); // Is the object
```

[![Build Status](https://travis-ci.org/Sam-Burns/dirty-needle.svg?branch=master)](https://travis-ci.org/Sam-Burns/dirty-needle)

dirty-needle
============

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

Releases are available supporting PHP5.3-5.6, with the 5.6-compatible releases being significantly faster in their implementation.

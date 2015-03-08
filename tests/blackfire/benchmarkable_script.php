<?php

require_once __DIR__ . '/../../vendor/autoload.php';

$diContainer = \DirtyNeedle\DiContainer::getInstance();
$diContainer->addConfigFile(__DIR__ . '/fixture_config_files/di.php');

$dependency = $diContainer->get('dependency-to-retrieve');

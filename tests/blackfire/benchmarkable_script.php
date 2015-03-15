<?php

require_once __DIR__ . '/../bootstrap.php';

$diContainer = \DirtyNeedle\DiContainer::getInstance();
$diContainer->addConfigFile(DIRTYNEEDLE_TEST_DIR . '/fixtures/config_files/sample_di_config.php');

$dependency = $diContainer->get('class-with-one-dependency');

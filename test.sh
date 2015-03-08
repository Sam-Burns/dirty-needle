#!/bin/bash

clear;

echo -e '\n\n###############';
echo '### PHPUNIT ###';
echo -e '###############\n\n';
vendor/bin/phpunit --config tests/phpunit/phpunit.xml;
echo -e '\n';

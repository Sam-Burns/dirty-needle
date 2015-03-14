#!/bin/bash

clear;

echo -e '\n\n###############';
echo '### PHPSPEC ###';
echo -e '###############\n\n';
vendor/bin/phpspec run --config tests/phpspec/phpspec.yml;

echo -e '\n\n###############';
echo '### PHPUNIT ###';
echo -e '###############\n\n';
vendor/bin/phpunit --config tests/phpunit/phpunit.xml;

echo -e '\n\n####################';
echo '### BEHAT INLINE ###';
echo -e '####################\n\n';
#vendor/bin/behat --config tests/behat/behat.yml --suite all_features;
echo -e 'To do: Implement behat tests\n\n';

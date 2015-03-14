<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use DirtyNeedle\DiContainer;

class FeatureContext implements Context, SnippetAcceptingContext
{
    public function __construct()
    {
        require_once __DIR__ . '/../../../../src-dev/bootstrap.php';
    }
}

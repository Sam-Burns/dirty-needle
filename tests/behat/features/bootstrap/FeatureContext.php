<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use DirtyNeedle\DiContainer;

class FeatureContext implements Context, SnippetAcceptingContext
{
    /** @var DiContainer */
    private $container;

    /** @var object */
    private $latestResultFromContainer;

    /** @var \Exception */
    private $lastExceptionFromContainer;

    public function __construct()
    {
        require_once __DIR__ . '/../../../bootstrap.php';
        $this->container = DiContainer::getInstance();
    }

    /**
     * @afterScenario
     */
    public function tearDown()
    {
        $this->container->reset();
    }

    /**
     * @Given my container is configured with :configFilename
     */
    public function myContainerIsConfiguredWith($configFilename)
    {
        $this->container->addConfigFile(DIRTYNEEDLE_TEST_DIR . '/fixtures/config_files/' . $configFilename);
    }

    /**
     * @Given I inject a mock :arg1 into the container as service ID :arg2
     */
    public function iInjectAMockIntoTheContainerAsServiceId($classname, $serviceId)
    {
        $phpunitMockGenerator = new PHPUnit_Framework_MockObject_Generator();
        $mockObject = $phpunitMockGenerator->getMock($classname, [], [], 'MockObject', false, false);
        $this->container->set($serviceId, $mockObject);
    }

    /**
     * @When I get the service :serviceId out of the container
     */
    public function iGetTheServiceOutOfTheContainer($serviceId)
    {
        $this->latestResultFromContainer = $this->container->get($serviceId);
    }

    /**
     * @Then the result should be an instance of a mock object
     */
    public function theResultShouldBeAnInstanceOfAMockObject()
    {
        PHPUnit_Framework_Assert::assertInstanceOf('MockObject', $this->latestResultFromContainer);
        $this->assertResultInstanceOf('MockObject');
    }

    /**
     * @Then the result should be an instance of :classname
     */
    public function theResultShouldBeAnInstanceOf($classname)
    {
        $this->assertResultInstanceOf($classname);
    }

    /**
     * @When I try to get the service :serviceId out of the container
     */
    public function iTryToGetTheServiceOutOfTheContainer($serviceId)
    {
        try {
            $this->container->get($serviceId);
        } catch (\Exception $exception) {
            $this->lastExceptionFromContainer = $exception;
        }
    }

    /**
     * @Then I should get a :exceptionClassname exception
     */
    public function iShouldGetAException($exceptionClassname)
    {
        $fullyQualifiedClassname = get_class($this->lastExceptionFromContainer);
        $simpleClassname = preg_replace('/^.+\\\([a-z]+)$/i', '$1', $fullyQualifiedClassname);
        PHPUnit_Framework_Assert::assertEquals($simpleClassname, $exceptionClassname);
    }

    /**
     * @param string $expectedClassname
     */
    private function assertResultInstanceOf($expectedClassname)
    {
        PHPUnit_Framework_Assert::assertInstanceOf($expectedClassname, $this->latestResultFromContainer);
    }
}

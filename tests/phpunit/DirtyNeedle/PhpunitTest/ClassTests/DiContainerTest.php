<?php
namespace DirtyNeedle\PhpunitTest\ClassTests;

use PHPUnit_Framework_TestCase as TestCase;
use DirtyNeedle\DiContainer;

class DiContainerTest extends TestCase
{
    /** @var DiContainer */
    private $diContainer;

    public function setUp()
    {
        $this->diContainer = DiContainer::getInstance();
        $this->diContainer->addConfigFile(__DIR__ . '/../../../fixtures/config_files/sample_di_config.php');
    }

    public function tearDown()
    {
        $this->diContainer->reset();
    }

    public function testGettingSimpleClass()
    {
        $result = $this->diContainer->get('simple-class');
        $this->assertInstanceOf('\DirtyNeedle\PhpunitTest\FixtureClasses\ClassWithNoDependencies', $result);
    }

    public function testGettingClassWithDependency()
    {
        $result = $this->diContainer->get('class-with-one-dependency');
        $this->assertInstanceOf('\DirtyNeedle\PhpunitTest\FixtureClasses\ClassWithOneDependency', $result);
    }
}

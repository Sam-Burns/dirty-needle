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
    }

    /**
     * @param $fixtureFilename
     */
    private function diIsConfiguredWith($fixtureFilename)
    {
        $this->diContainer->addConfigFile(__DIR__ . '/../../../fixtures/config_files/' . $fixtureFilename);
    }

    public function tearDown()
    {
        $this->diContainer->reset();
    }

    public function testGettingSimpleClass()
    {
        $this->diIsConfiguredWith('sample_di_config.php');
        $result = $this->diContainer->get('simple-class');
        $this->assertInstanceOf('\DirtyNeedle\PhpunitTest\FixtureClasses\ClassWithNoDependencies', $result);
    }

    public function testGettingClassWithDependency()
    {
        $this->diIsConfiguredWith('sample_di_config.php');
        $result = $this->diContainer->get('class-with-one-dependency');
        $this->assertInstanceOf('\DirtyNeedle\PhpunitTest\FixtureClasses\ClassWithOneDependency', $result);
    }

    /**
     * @expectedException \DirtyNeedle\Exception\ServiceDefinitionNotFound
     */
    public function testGettingNonExistentClass()
    {
        $this->diIsConfiguredWith('sample_di_config.php');
        $this->diContainer->get('made-up-service');
    }

    /**
     * @expectedException \DirtyNeedle\Exception\CyclicDependencyInDiConfig
     * @expectedExceptionMessage Cyclic dependency found while trying to retrieve "class-a" from container
     */
    public function testCanDetectCyclicDependencies()
    {
        $this->diIsConfiguredWith('cyclic_dependencies.php');
        $this->diContainer->get('class-a');
    }
}

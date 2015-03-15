<?php
namespace DirtyNeedle\PhpunitTest\ClassTests\ObjectBuilding;

use DirtyNeedle\ObjectBuilding\ObjectBuilderFactory;
use DirtyNeedle\TestFixtures\Simple\SimpleDependency;

class ObjectBuilderIntegrationTest extends \PHPUnit_Framework_TestCase
{
    public function testGettingAnObjectBuilder()
    {
        $objectBuilderFactory = new ObjectBuilderFactory();
        $objectBuilder = $objectBuilderFactory->getObjectBuilder();
        $this->assertInstanceOf('\DirtyNeedle\ObjectBuilding\ObjectBuilder', $objectBuilder);
    }

    public function testBuildingAnObject()
    {
        $objectBuilderFactory = new ObjectBuilderFactory();
        $objectBuilder = $objectBuilderFactory->getObjectBuilder();
        $object = $objectBuilder->buildObject('\stdClass', []);
        $this->assertInstanceOf('\stdClass', $object);
    }

    public function testBuildingAnObjectWithParameters()
    {
        // ARRANGE
        $objectBuilderFactory = new ObjectBuilderFactory();
        $objectBuilder = $objectBuilderFactory->getObjectBuilder();

        $desiredClassname = '\DirtyNeedle\TestFixtures\NestedDependencies\ClassWithOneDependency';
        $arrayOfParameters = [new SimpleDependency()];

        // ACT
        $object = $objectBuilder->buildObject($desiredClassname, $arrayOfParameters);

        // ASSERT
        $this->assertInstanceOf($desiredClassname, $object);
    }
}

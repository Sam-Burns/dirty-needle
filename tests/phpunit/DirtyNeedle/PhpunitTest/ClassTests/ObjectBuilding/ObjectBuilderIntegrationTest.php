<?php
namespace DirtyNeedle\PhpunitTest\ClassTests\ObjectBuilding;

use DirtyNeedle\ObjectBuilding\ObjectBuilderFactory;

class ObjectBuilderIntergrationTest extends \PHPUnit_Framework_TestCase
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
}

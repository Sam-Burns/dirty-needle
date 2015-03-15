<?php

namespace DirtyNeedleSpec\DirtyNeedle\ObjectBuilding;

use DirtyNeedle\TestFixtures\NestedDependencies\ClassWithOneDependency;
use DirtyNeedle\TestFixtures\Simple\SimpleDependency;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ObjectBuilderSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('DirtyNeedle\ObjectBuilding\ObjectBuilder');
    }

    function it_can_build_an_object_with_no_parameters()
    {
        $classnameToBuild = '\stdClass';
        $constructorParameters = [];
        $expectedResult = new \stdClass();

        $this->buildObject($classnameToBuild, $constructorParameters)->shouldBeLike($expectedResult);
    }

    function it_can_build_an_object_with_parameters()
    {
        $classnameToBuild = '\DirtyNeedle\TestFixtures\NestedDependencies\ClassWithOneDependency';
        $constructorParameters = [new SimpleDependency()];
        $expectedResult = new ClassWithOneDependency($constructorParameters[0]);

        $this->buildObject($classnameToBuild, $constructorParameters)->shouldBeLike($expectedResult);
    }
}

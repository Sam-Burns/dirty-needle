<?php

namespace DirtyNeedleSpec\DirtyNeedle\Definitions;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ServiceDefinitionSpec extends ObjectBehavior
{
    function let()
    {
        $serviceId = 'service-id';

        $definitionArray = array(
            'class' => '\DirtyNeedle\TestFixtures\NestedDependencies\ClassWithOneDependency',
            'arguments' => array(
                'simple-dependency'
            )
        );

        $this->beConstructedWith($serviceId, $definitionArray);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('DirtyNeedle\Definitions\ServiceDefinition');
    }

    function it_can_get_class()
    {
        $this->getClass()->shouldBe('\DirtyNeedle\TestFixtures\NestedDependencies\ClassWithOneDependency');
    }

    function it_can_get_arguments()
    {
        $this->getArguments()->shouldBe(['simple-dependency']);
    }

    function it_knows_if_there_are_arguments()
    {
        $this->hasArguments()->shouldBe(true);
    }
}

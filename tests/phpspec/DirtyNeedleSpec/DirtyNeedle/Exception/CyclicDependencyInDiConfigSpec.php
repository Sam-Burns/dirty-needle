<?php

namespace DirtyNeedleSpec\DirtyNeedle\Exception;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CyclicDependencyInDiConfigSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedThrough('constructWithServiceId', ['service-id']);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('DirtyNeedle\Exception\CyclicDependencyInDiConfig');
    }

    function it_has_a_helpful_message()
    {
        $this->getMessage()->shouldBe('Cyclic dependency found while trying to retrieve "service-id" from container');
    }
}

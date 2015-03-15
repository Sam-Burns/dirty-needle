<?php

namespace DirtyNeedleSpec\DirtyNeedle\Exception;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ClassnameNotSpecifiedForDependencySpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedThrough('constructWithServiceId', ['service-id']);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('DirtyNeedle\Exception\ClassnameNotSpecifiedForDependency');
    }

    function it_has_a_helpful_message()
    {
        $this->getMessage()->shouldBe('Classname not specified for service with ID "service-id"');
    }
}

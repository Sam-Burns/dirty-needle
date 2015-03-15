<?php

namespace DirtyNeedleSpec\DirtyNeedle\Exception;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ServiceDefinitionNotFoundSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedThrough('constructWithServiceId', ['service-id']);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('DirtyNeedle\Exception\ServiceDefinitionNotFound');
    }

    function it_has_a_helpful_message()
    {
        $this->getMessage()->shouldBe('Service ID "service-id" not found in DI config.');
    }
}

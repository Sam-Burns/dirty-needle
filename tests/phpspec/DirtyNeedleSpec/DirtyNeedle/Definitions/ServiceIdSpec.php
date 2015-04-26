<?php
namespace DirtyNeedleSpec\DirtyNeedle\Definitions;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use DirtyNeedle\Definitions\ServiceId;

class ServiceIdSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('service');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('DirtyNeedle\Definitions\ServiceId');
    }

    function it_can_become_a_string_array_key()
    {
        $this->__toString()->shouldBe('service');
    }

    function it_can_validate_itself_when_invalid()
    {
        $this->shouldThrow('\DirtyNeedle\Exception\AnonymousService')->during('__construct', array(''));
    }

    function it_can_strip_at_signs_from_service_ids()
    {
        $this->beConstructedWith('@service');
        $this->__toString()->shouldBe('service');
    }
}

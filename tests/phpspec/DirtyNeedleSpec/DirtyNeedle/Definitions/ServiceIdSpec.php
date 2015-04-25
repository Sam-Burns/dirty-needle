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
}

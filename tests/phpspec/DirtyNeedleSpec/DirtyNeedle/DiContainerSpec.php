<?php

namespace DirtyNeedleSpec\DirtyNeedle;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DiContainerSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedThrough('getInstance', array());
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('DirtyNeedle\DiContainer');
    }
}

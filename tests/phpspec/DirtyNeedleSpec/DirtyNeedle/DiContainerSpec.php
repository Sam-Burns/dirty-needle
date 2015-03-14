<?php

namespace DirtyNeedleSpec\DirtyNeedle;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DiContainerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('DirtyNeedle\DiContainer');
    }
}

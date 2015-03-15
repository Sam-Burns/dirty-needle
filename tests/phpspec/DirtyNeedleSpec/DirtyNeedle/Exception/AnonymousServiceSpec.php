<?php

namespace DirtyNeedleSpec\DirtyNeedle\Exception;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AnonymousServiceSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('DirtyNeedle\Exception\AnonymousService');
    }

    function it_has_a_helpful_message()
    {
        $this->getMessage()->shouldBe('A service exists in the config file with no Service ID');
    }
}

<?php

namespace DirtyNeedleSpec\DirtyNeedle\Exception;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DiConfigNotFoundSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedThrough('constructWithFilename', ['filename.php']);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('DirtyNeedle\Exception\DiConfigNotFound');
    }

    function it_has_a_helpful_message()
    {
        $this->getMessage()->shouldBe('File named "filename.php" does not contain configuration for Dirty Needle dependency injection');
    }
}

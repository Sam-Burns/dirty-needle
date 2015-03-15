<?php

namespace DirtyNeedleSpec\DirtyNeedle\Exception;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DiConfigNotReadableSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedThrough('constructWithFilename', ['filename.php']);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('DirtyNeedle\Exception\DiConfigNotReadable');
    }

    function it_has_a_helpful_message()
    {
        $this->getMessage()->shouldBe('File named "filename.php" is not readable');
    }
}

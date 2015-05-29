<?php

namespace spec\Knp\Rad\Prototype\Prototype;

use Knp\Rad\Prototype\Prototype\Method;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BaseSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Knp\Rad\Prototype\Prototype\Base');
    }

    function it_call_its_methods()
    {
        $this->cetera = new Method('Prophecy\Argument', 'cetera');

        $this->cetera()->shouldHaveType('Prophecy\Argument\Token\AnyValuesToken');
    }
}

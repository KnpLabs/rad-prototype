<?php

namespace spec\Knp\Rad\Prototype\Prototype;

use Knp\Rad\Prototype\Prototype;
use Knp\Rad\Prototype\Prototype\Method;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ContainerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Knp\Rad\Prototype\Prototype\Container');
    }

    function it_can_apply_methods_to_prototype(Prototype $prototype, Method $method1, Method $method2, Method $method3)
    {
        $prototype->canReach('doctrine')->willReturn(true);
        $prototype->canReach('router')->willReturn(false);

        $prototype->__call('__set', ['getMethod1', $method1])->shouldBeCalled();
        $prototype->__call('__set', ['getMethod3', $method3])->shouldBeCalled();

        $this->addMethod('getMethod1', $method1, 'doctrine');
        $this->addMethod('getMethod2', $method2, 'router');
        $this->addMethod('getMethod3', $method3, 'doctrine');

        $this->applyTo($prototype);
    }
}

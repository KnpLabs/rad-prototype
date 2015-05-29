<?php

namespace spec\Knp\Rad\Prototype\EventListener;

use Knp\Rad\Prototype\Prototype;
use Knp\Rad\Prototype\Prototype\Container;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;

class ControllerAsPrototypeListenerSpec extends ObjectBehavior
{
    function let(Container $container, Prototype $prototype, FilterControllerEvent $event)
    {
        $this->beConstructedWith($container);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Knp\Rad\Prototype\EventListener\ControllerAsPrototypeListener');
    }

    function it_apply_methods_on_prototype($container, $prototype, $event)
    {
        $event->getController()->willReturn($prototype);

        $container->applyTo($prototype)->shouldBeCalled();

        $this->onController($event);
    }

    function it_also_apply_methods_on_prototype_if_its_a_callable($container, $prototype, $event)
    {
        $event->getController()->willReturn([$prototype, 'action']);

        $container->applyTo($prototype)->shouldBeCalled();

        $this->onController($event);
    }

    function it_doesnt_apply_on_other_controllers($container, $event, $controller)
    {
        $event->getController()->willReturn([$controller, 'action']);

        $container->applyTo(Argument::any())->shouldNotBeCalled();

        $this->onController($event);
    }
}

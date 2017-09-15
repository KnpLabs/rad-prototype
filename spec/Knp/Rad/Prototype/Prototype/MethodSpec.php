<?php

namespace spec\Knp\Rad\Prototype\Prototype;

use PhpSpec\ObjectBehavior;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class MethodSpec extends ObjectBehavior
{
    function let(Bundle $bundle)
    {
        $this->beConstructedWith($bundle, 'build');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Knp\Rad\Prototype\Prototype\Method');
    }

    function it_proxify_a_method($bundle, ContainerBuilder $container)
    {
        $bundle->build($container)->shouldBeCalled()->willReturn(null);

        $this($container);
    }

    function it_returns_proxified_result($bundle, Extension $extension)
    {
        $this->beConstructedWith($bundle, 'getContainerExtension');

        $bundle->getContainerExtension()->willReturn($extension);

        $this()->shouldReturn($extension);
    }

    function it_proxify_a_method_of_a_static_class()
    {
        $this->beConstructedWith('Prophecy\Argument', 'cetera');

        $this()->shouldHaveType('Prophecy\Argument\Token\AnyValuesToken');
    }
}

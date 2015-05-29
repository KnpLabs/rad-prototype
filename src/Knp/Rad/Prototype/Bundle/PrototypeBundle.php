<?php

namespace Knp\Rad\Prototype\Bundle;

use Knp\Rad\Prototype\DependencyInjection\Compiler\MethodRegistrationPass;
use Knp\Rad\Prototype\DependencyInjection\Compiler\StaticMethodRegistrationPass;
use Knp\Rad\Prototype\DependencyInjection\PrototypeExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class PrototypeBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new StaticMethodRegistrationPass());
        $container->addCompilerPass(new MethodRegistrationPass());
    }

    /**
     * {@inheritdoc}
     */
    public function getContainerExtension()
    {
        return new PrototypeExtension();
    }
}

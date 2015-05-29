<?php

namespace Knp\Rad\Prototype\Bundle;

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
    }

    /**
     * {@inheritdoc}
     */
    public function getContainerExtension()
    {
        return new PrototypeExtension();
    }
}

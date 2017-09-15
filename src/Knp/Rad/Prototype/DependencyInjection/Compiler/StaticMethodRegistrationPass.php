<?php

namespace Knp\Rad\Prototype\DependencyInjection\Compiler;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

class StaticMethodRegistrationPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../../Resources/config'));

        $services = ['doctrine', 'router', 'form'];

        foreach ($services as $service) {
            if (false === $container->hasDefinition($service) && false === $container->hasAlias($service)) {
                continue;
            }

            $loader->load(sprintf('%s.xml', $service));
        }
    }
}

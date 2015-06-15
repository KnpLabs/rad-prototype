<?php

namespace Knp\Rad\Prototype\DependencyInjection\Compiler;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class StaticMethodRegistrationPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../../Resources/config'));

        $services = ['doctrine', 'router', 'request_stack'];

        foreach ($services as $service) {
            if (false === $container->hasDefinition($service) && false === $container->hasAlias($service)) {
                continue;
            }

            $loader->load(sprintf('%s.yml', $service));
        }
    }
}

<?php

namespace Knp\Rad\Prototype\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class MethodRegistrationPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $methods     = $container->findTaggedServiceIds('knp_rad_prototype.method');
        $definitions = [];

        foreach ($methods as $id => $tags) {
            foreach ($tags as $tag) {
                $tag = array_merge([
                    'alias'  => $tag['method'],
                    'domain' => null
                ], $tag);

                $definition = new Definition('Knp\Rad\Prototype\Prototype\Method', [
                    sprintf('@%s', $id), $tag['method']
                ]);
                $definition->addTag('knp_rad_prototype.prototype_method', $tag);

                $name = sprintf('knp_rad_prototype.prototype.method.%s', Inflector::tableize($tag['alias']));

                $container->setDefinition($name, $definition);
            }
        }

        $methodContainer = $container->getDefinition('knp_rad_prototype.prototype.container');
        $methods         = $container->findTaggedServiceIds('knp_rad_prototype.prototype_method');

        foreach ($methods as $id => $tags) {
            $tag = current($tags);

            $methodContainer
                ->addMethodCall('addMethod', [$tag['alias'], new Reference($id), $tag['domain']])
            ;
        }
    }
}

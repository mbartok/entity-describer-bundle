<?php

namespace mbartok\EntityDescriberBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class EntityDescriberCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('mbartok_entity_describer.manager')) {
            return;
        }

        $definition = $container->getDefinition('mbartok_entity_describer.manager');
        $taggedServices = $container->findTaggedServiceIds('mbartok_entity_describer');

        foreach ($taggedServices as $id => $tags) {
            foreach ($tags as $attributes) {
                $definition->addMethodCall('addDescriber', array(
                    new Reference($id),
                    $attributes["entity"]
                ));
            }
        }
    }
}
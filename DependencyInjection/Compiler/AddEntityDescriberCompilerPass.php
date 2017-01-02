<?php

namespace mbartok\EntityDescriberBundle\DependencyInjection\Compiler;

use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class AddEntityDescriberCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('mbartok_entity_describer.manager')) {
            return;
        }

        $taggedServices = $container->findTaggedServiceIds('mbartok_entity_describer');
        if (0 === count($taggedServices)) {
            return;
        }

        $definition = $container->getDefinition('mbartok_entity_describer.manager');

        if (!method_exists($container->getParameterBag()->resolveValue($definition->getClass()), 'addDescriber')) {
            throw new InvalidConfigurationException(sprintf(
                'To use entity describers, the service of class "%s" registered as mbartok_entity_describer.manager must implement the "addDescriber" method',
                $definition->getClass()
            ));
        }

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
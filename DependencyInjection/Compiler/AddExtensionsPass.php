<?php

namespace mbartok\EntityDescriberBundle\DependencyInjection\Compiler;

use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class AddExtensionsPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('mbartok_entity_describer.factory')) {
            return;
        }

        $taggedServices = $container->findTaggedServiceIds('mbartok_entity_describer.factory_extension');
        if (0 === count($taggedServices)) {
            return;
        }

        $definition = $container->getDefinition('mbartok_entity_describer.factory');

        if (!method_exists($container->getParameterBag()->resolveValue($definition->getClass()), 'addExtension')) {
            throw new InvalidConfigurationException(sprintf(
                'To use factory extensions, the service of class "%s" registered as mbartok_entity_describer.factory must implement the "addExtension" method',
                $definition->getClass()
            ));
        }

        foreach ($taggedServices as $id => $tags) {
            foreach ($tags as $tag) {
                $priority = isset($tag['priority']) ? $tag['priority'] : 0;
                $definition->addMethodCall('addExtension', array(new Reference($id), $priority));
            }
        }
    }
}

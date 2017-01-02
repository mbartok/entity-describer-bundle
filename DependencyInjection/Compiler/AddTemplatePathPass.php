<?php

namespace mbartok\EntityDescriberBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class AddTemplatePathPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $loaderDefinition = null;

        if ($container->hasDefinition('twig.loader.filesystem')) {
            $loaderDefinition = $container->getDefinition('twig.loader.filesystem');
        }

        if (null === $loaderDefinition) {
            return;
        }

        $path = __DIR__ . '/../../Resources/views';
        $loaderDefinition->addMethodCall('addPath', array($path));
    }
}
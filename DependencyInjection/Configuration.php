<?php

namespace mbartok\EntityDescriberBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();

        $rootNode = $treeBuilder->root('mbartok_entity_describer');
        $rootNode
            ->children()
            ->scalarNode('template')
            ->defaultValue('MbartokEntityDescriberBundle:mbartok_entity_describer_items.html.twig')
            ->end();

        return $treeBuilder;
    }
}

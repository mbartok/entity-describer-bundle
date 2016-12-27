<?php

namespace mbartok\EntityDescriberBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree.
     *
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('mbartok_entity_describer');
        $rootNode
            ->children()
            ->scalarNode('namespace')->cannotBeEmpty()->end()
            ->scalarNode('directory')->cannotBeEmpty()->end()
            ->end();
        return $treeBuilder;
    }
}
<?php

namespace Socloz\StateBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;

/**
 * This class contains the configuration information for the bundle
 *
 * This information is solely responsible for how the different configuration
 * sections are normalized, and merged.
 *
 * @author Alex Kleissner <hex337@gmail.com>
 */
class Configuration
{
    /**
     * Generates the configuration tree.
     *
     * @return \Symfony\Component\DependencyInjection\Configuration\NodeInterface
     */
    public function getConfigTree()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('socloz_state');

        $rootNode
            ->children()
                ->arrayNode('storage')
                    ->children()
                        ->scalarNode('prefix')->defaultValue('socloz_state')->end()
                        ->arrayNode('redis')
                            ->children()
                                ->scalarNode('host')->end()
                                ->scalarNode('port')->defaultValue(6379)->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder->buildTree();
    }
}

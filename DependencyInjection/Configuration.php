<?php

namespace Discutea\MediaBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    const ALIAS = 'discutea_media';

    /**
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root(self::ALIAS);
        $rootNode
            ->children()
                ->arrayNode('config')
                    ->children()
                        ->scalarNode('media_class')->end()
                        ->scalarNode('path')->end()
                        ->scalarNode('url')->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}

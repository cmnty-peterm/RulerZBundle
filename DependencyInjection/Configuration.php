<?php

namespace KPhoen\RulerZBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('rulerz');

        $this->addCacheConfig($rootNode);
        $this->addDebugConfig($rootNode);
        $this->addExecutorsConfig($rootNode);

        return $treeBuilder;
    }

    private function addCacheConfig(ArrayNodeDefinition $rootNode)
    {
        $rootNode
            ->children()
                ->scalarNode('cache')->defaultValue('%kernel.cache_dir%/rulerz')->end()
            ->end();

        return $rootNode;
    }

    private function addDebugConfig(ArrayNodeDefinition $rootNode)
    {
        $rootNode
            ->children()
                ->booleanNode('debug')->defaultValue('%kernel.debug%')->end()
            ->end();

        return $rootNode;
    }

    private function addExecutorsConfig(ArrayNodeDefinition $rootNode)
    {
        $rootNode
            ->children()
                ->arrayNode('executors')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->booleanNode('doctrine')->defaultFalse()->end()
                        ->booleanNode('eloquent')->defaultFalse()->end()
                        ->booleanNode('pomm')->defaultFalse()->end()
                        ->booleanNode('elastica')->defaultFalse()->end()
                        ->booleanNode('elasticsearch')->defaultFalse()->end()
                    ->end()
                ->end()
            ->end();

        return $rootNode;
    }
}

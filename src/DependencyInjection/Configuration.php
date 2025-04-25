<?php

declare(strict_types=1);

namespace ACSEO\SyliusBrandPlugin\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    /**
     * @psalm-suppress UnusedVariable
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('acseo_sylius_brand');
        $rootNode = $treeBuilder->getRootNode();

        return $treeBuilder;
    }
}

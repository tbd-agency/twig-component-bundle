<?php

namespace Tbd\ComponentBundle;

use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;
use function dirname;

final class TbdComponentBundle extends AbstractBundle
{
    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $container->import(__DIR__ . '/../config/services.php');

        $builder->setParameter('button.variants', $config['button']['variants']);
        $builder->setParameter('button.sizes', $config['button']['sizes']);

        $builder->setParameter('icon.sizes', $config['icon']['sizes']);
    }

    public function configure(DefinitionConfigurator $definition): void
    {
        $definition->rootNode()
            ->children()
            ->stringNode('template')
            ->end()
            ->arrayNode('button')
            ->addDefaultsIfNotSet()
            ->children()
            ->arrayNode('variants')
            ->useAttributeAsKey('name')
            ->scalarPrototype()
            ->end()
            ->end()
            ->arrayNode('sizes')
            ->useAttributeAsKey('name')
            ->scalarPrototype()
            ->end()
            ->end()
            ->end()
            ->end()
            ->arrayNode('icon')
            ->addDefaultsIfNotSet()
            ->children()
            ->arrayNode('sizes')
            ->useAttributeAsKey('name')
            ->scalarPrototype()
            ->end()
            ->end()
            ->end()
            ->end()
            ->end();
    }

    public function prependExtension(ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $configs = $builder->getExtensionConfig('tbd_component');

        # Tell twig what template to use for the components
        $template = $configs[0]['template'] ?? '@@TbdComponent/default.html.twig';
        $builder->prependExtensionConfig('twig', [
            'globals' => [
                'tbd_component_template' => $template,
            ],
        ]);

        # Allow twig to detect icons from the package
        $builder->prependExtensionConfig('ux_icons', [
            'icon_sets' => [
                'tbd' => [
                    'path' => dirname(__DIR__) . '/assets/icons',
                    'prefix' => 'tbd',
                ],
            ],
        ]);
    }
}

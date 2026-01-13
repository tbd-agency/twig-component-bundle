<?php

namespace Tbd\TwigComponentBundle;

use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;
use function dirname;

final class TbdTwigComponentBundle extends AbstractBundle
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
            ->defaultValue('@@TbdComponent/default.html.twig')
            ->end()
            ->arrayNode('button')
            ->addDefaultsIfNotSet()
            ->children()
            ->arrayNode('variants')
            ->useAttributeAsKey('name')
            ->scalarPrototype()->end()
            ->defaultValue([
                'primary' => 'text-white fill-white bg-orange-400 hover:bg-orange-500 focus:ring-orange-300',
            ])
            ->end()
            ->arrayNode('sizes')
            ->useAttributeAsKey('name')
            ->scalarPrototype()->end()
            ->defaultValue([
                'sm' => 'px-2 py-1 text-xs',
                'md' => 'px-3 py-2 text-sm',
                'lg' => 'px-4 py-2 text-base',
            ])
            ->end()
            ->end()
            ->end()
            ->arrayNode('icon')
            ->addDefaultsIfNotSet()
            ->children()
            ->arrayNode('sizes')
            ->useAttributeAsKey('name')
            ->scalarPrototype()->end()
            ->defaultValue([
                'sm' => 'w-3 h-3',
                'md' => 'w-4 h-4',
                'lg' => 'w-5 h-5',
            ])
            ->end()
            ->end()
            ->end()
            ->end();
    }

    public function prependExtension(ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $configs = $builder->getExtensionConfig('tbd_twig_component');

        # Tell twig what template to use for the components
        $template = $configs[0]['template'] ?? '@@TbdTwigComponent/default.html.twig';
        $builder->prependExtensionConfig('twig', [
            'globals' => [
                'tbd_twig_component_template' => $template,
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

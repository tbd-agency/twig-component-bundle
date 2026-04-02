<?php

namespace Tbd\TwigComponentBundle;

use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;
use function dirname;

final class TbdTwigComponentBundle extends AbstractBundle
{
    public function prependExtension(ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $configs = $builder->getExtensionConfig('tbd_twig_component');

        // Tell twig what template to use for the components
        $template = $configs[0]['template'] ?? '@@TbdTwigComponent/default.html.twig';
        $builder->prependExtensionConfig('twig', [
            'globals' => [
                'tbd_twig_component_template' => $template,
            ],
        ]);

        // Allow twig to detect icons from the package
        $builder->prependExtensionConfig('ux_icons', [
            'icon_sets' => [
                'tbd' => [
                    'path' => dirname(__DIR__) . '/assets/icons',
                    'prefix' => 'tbd',
                ],
            ],
        ]);
    }

    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $container->import(__DIR__ . '/../config/services.php');

        $builder->setParameter('button.variants', array_replace(self::DEFAULT_BUTTON_VARIANTS, $config['button']['variants'] ?? []));
        $builder->setParameter('button.sizes', array_replace(self::DEFAULT_BUTTON_SIZES, $config['button']['sizes'] ?? []));

        $builder->setParameter('icon.sizes', array_replace(self::DEFAULT_ICON_SIZES, $config['icon']['sizes']));

        $builder->setParameter('avatar.sizes', array_replace(self::DEFAULT_AVATAR_SIZES, $config['avatar']['sizes'] ?? []));
        $builder->setParameter('avatar.borderRadii', array_replace(self::DEFAULT_AVATAR_BORDER_RADII, $config['avatar']['border_radii'] ?? []));

        $builder->setParameter('alert.types', array_replace(self::DEFAULT_ALERT_TYPES, $config['alert']['types'] ?? []));

        $builder->setParameter('badge.variants', array_replace(self::DEFAULT_BADGE_VARIANTS, $config['badge']['variants'] ?? []));
        $builder->setParameter('badge.sizes', array_replace(self::DEFAULT_BADGE_SIZES, $config['badge']['sizes'] ?? []));

        $builder->setParameter('card.paddings', array_replace(self::DEFAULT_CARD_PADDINGS, $config['card']['paddings'] ?? []));

        $builder->setParameter('link.prependIconMargins', array_replace(self::DEFAULT_LINK_PREPEND_ICON_MARGINS, $config['link']['prepend_icon_margins'] ?? []));
        $builder->setParameter('link.appendIconMargins', array_replace(self::DEFAULT_LINK_APPEND_ICON_MARGINS, $config['link']['append_icon_margins'] ?? []));

        $builder->setParameter('section.paddings', array_replace(self::DEFAULT_SECTION_PADDINGS, $config['section']['paddings'] ?? []));

        $builder->setParameter('sub_title.font_sizes', array_replace(self::DEFAULT_SUB_TITLE_FONT_SIZES, $config['sub_title']['font_sizes'] ?? []));

        $builder->setParameter('table.sticky_cell.positions', array_replace(self::DEFAULT_TABLE_STICKY_CELL_POSITIONS, $config['table']['sticky_cell']['positions'] ?? []));

        $builder->setParameter('nav.badge_type', array_replace(self::DEFAULT_TABLE_STICKY_CELL_POSITIONS, $config['nav']['badge_type'] ?? []));

        $builder->setParameter('logo.sizes', array_replace(self::DEFAULT_LOGO_SIZES, $config['logo']['sizes'] ?? []));
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
            ->normalizeKeys(false)
            ->scalarPrototype()->end()
            ->defaultValue(self::DEFAULT_BUTTON_VARIANTS)
            ->end()
            ->arrayNode('sizes')
            ->useAttributeAsKey('name')
            ->normalizeKeys(false)
            ->scalarPrototype()->end()
            ->defaultValue(self::DEFAULT_BUTTON_SIZES)
            ->end()
            ->end()
            ->end()
            ->arrayNode('icon')
            ->addDefaultsIfNotSet()
            ->children()
            ->arrayNode('sizes')
            ->useAttributeAsKey('name')
            ->normalizeKeys(false)
            ->scalarPrototype()->end()
            ->defaultValue(self::DEFAULT_ICON_SIZES)
            ->end()
            ->end()
            ->end()
            ->arrayNode('avatar')
            ->addDefaultsIfNotSet()
            ->children()
            ->arrayNode('sizes')
            ->useAttributeAsKey('name')
            ->normalizeKeys(false)
            ->scalarPrototype()->end()
            ->defaultValue(self::DEFAULT_AVATAR_SIZES)
            ->end()
            ->arrayNode('border_radii')
            ->useAttributeAsKey('name')
            ->normalizeKeys(false)
            ->scalarPrototype()->end()
            ->defaultValue(self::DEFAULT_AVATAR_BORDER_RADII)
            ->end()
            ->end()
            ->end()
            ->arrayNode('alert')
            ->addDefaultsIfNotSet()
            ->children()
            ->arrayNode('types')
            ->useAttributeAsKey('name')
            ->normalizeKeys(false)
            ->scalarPrototype()->end()
            ->defaultValue(self::DEFAULT_ALERT_TYPES)
            ->end()
            ->end()
            ->end()
            ->arrayNode('badge')
            ->addDefaultsIfNotSet()
            ->children()
            ->arrayNode('variants')
            ->useAttributeAsKey('name')
            ->normalizeKeys(false)
            ->scalarPrototype()->end()
            ->defaultValue(self::DEFAULT_BADGE_VARIANTS)
            ->end()
            ->arrayNode('sizes')
            ->useAttributeAsKey('name')
            ->normalizeKeys(false)
            ->scalarPrototype()->end()
            ->defaultValue(self::DEFAULT_BADGE_SIZES)
            ->end()
            ->end()
            ->end()
            ->arrayNode('card')
            ->addDefaultsIfNotSet()
            ->children()
            ->arrayNode('paddings')
            ->useAttributeAsKey('name')
            ->normalizeKeys(false)
            ->scalarPrototype()->end()
            ->defaultValue(self::DEFAULT_CARD_PADDINGS)
            ->end()
            ->end()
            ->end()
            ->arrayNode('link')
            ->addDefaultsIfNotSet()
            ->children()
            ->arrayNode('prepend_icon_margins')
            ->useAttributeAsKey('name')
            ->normalizeKeys(false)
            ->scalarPrototype()->end()
            ->defaultValue(self::DEFAULT_LINK_PREPEND_ICON_MARGINS)
            ->end()
            ->arrayNode('append_icon_margins')
            ->useAttributeAsKey('name')
            ->normalizeKeys(false)
            ->scalarPrototype()->end()
            ->defaultValue(self::DEFAULT_LINK_APPEND_ICON_MARGINS)
            ->end()
            ->end()
            ->end()
            ->arrayNode('section')
            ->addDefaultsIfNotSet()
            ->children()
            ->arrayNode('paddings')
            ->useAttributeAsKey('name')
            ->normalizeKeys(false)
            ->scalarPrototype()->end()
            ->defaultValue(self::DEFAULT_SECTION_PADDINGS)
            ->end()
            ->end()
            ->end()
            ->arrayNode('sub_title')
            ->addDefaultsIfNotSet()
            ->children()
            ->arrayNode('font_sizes')
            ->useAttributeAsKey('name')
            ->normalizeKeys(false)
            ->scalarPrototype()->end()
            ->defaultValue(self::DEFAULT_SUB_TITLE_FONT_SIZES)
            ->end()
            ->end()
            ->end()
            ->arrayNode('table')
            ->addDefaultsIfNotSet()
            ->children()
            ->arrayNode('sticky_cell')
            ->addDefaultsIfNotSet()
            ->children()
            ->arrayNode('positions')
            ->useAttributeAsKey('name')
            ->normalizeKeys(false)
            ->scalarPrototype()->end()
            ->defaultValue(self::DEFAULT_TABLE_STICKY_CELL_POSITIONS)
            ->end()
            ->end()
            ->end()
            ->end()
            ->end()
            ->arrayNode('nav')
            ->addDefaultsIfNotSet()
            ->children()
            ->arrayNode('badge_type')
            ->useAttributeAsKey('name')
            ->normalizeKeys(false)
            ->scalarPrototype()->end()
            ->defaultValue(self::DEFAULT_DROPDOWN_BADGE_TYPE)
            ->end()
            ->end()
            ->end()
            ->arrayNode('logo')
            ->addDefaultsIfNotSet()
            ->children()
            ->arrayNode('sizes')
            ->useAttributeAsKey('name')
            ->normalizeKeys(false)
            ->scalarPrototype()->end()
            ->defaultValue(self::DEFAULT_LOGO_SIZES)
            ->end()
            ->end()
            ->end()
            ->end();
    }

    private const array DEFAULT_BUTTON_VARIANTS = [
        'primary' => 'text-white fill-white bg-orange-400 hover:bg-orange-500 focus:ring-orange-300',
        'tab' => '!rounded-none !px-0 text-blue-950 hover:text-blue-800 pb-2 border-b-2 border-transparent',
        'tab-active' => '!rounded-none !px-0 text-blue-950 hover:text-blue-800 pb-2 border-b-2 border-blue-950 hover:border-blue-800',
        'hollow' => 'text-blue-950 fill-blue-950 dark:text-white dark:fill-white hover:bg-white dark:hover:bg-blue-950 border border-gray-200 dark:border-gray-600 hover:text-orange-400 hover:fill-orange-400 dark:hover:text-orange-400 dark:hover:fill-orange-400 focus:text-white focus:fill-white dark:focus:text-white dark:focus:fill-white focus:border-orange-400 dark:focus:border-orange-400 focus:bg-orange-400 dark:focus:bg-orange-400 focus:ring-orange-300 dark:focus:ring-orange-300',
        'hollow-error' => 'text-red-500 text-bold border-transparent hover:text-red-600',
        'hollow-success' => 'text-green-700 text-bold border-transparent hover:text-green-800',
        'multi-level' => 'w-full !text-base !font-normal rounded-none hover:bg-gray-100',
    ];

    private const array DEFAULT_BUTTON_SIZES = [
        'none' => 'p-0!',
        'sm' => 'px-2 py-1',
        'md' => 'px-3 py-2',
        'lg' => 'px-4 py-2',
    ];

    private const array DEFAULT_ICON_SIZES = [
        'sm' => 'w-3 h-3',
        'md' => 'w-4 h-4',
        'lg' => 'w-5 h-5',
    ];

    private const array DEFAULT_AVATAR_SIZES = [
        'sm' => 'w-7 h-7',
        'md' => 'w-8 h-8',
        'lg' => 'w-9 h-9',
    ];

    private const array DEFAULT_AVATAR_BORDER_RADII = [
        'rounded' => 'rounded',
        'full' => 'rounded-full',
    ];

    private const array DEFAULT_ALERT_TYPES = [
        'error' => 'border-red-400 bg-red-50 text-red-600',
        'success' => 'border-green-500 bg-green-50 text-green-700',
        'warning' => 'border-yellow-500 bg-yellow-100 text-yellow-700',
        'default' => 'bg-white text-blue-950',
    ];

    private const array DEFAULT_BADGE_VARIANTS = [
        'primary' => 'text-white bg-light-blue',
        'gray' => 'text-blue-950 bg-gray-200',
        'green' => 'text-white bg-green-500',
        'red' => 'text-white bg-red-500',
        'orange' => 'text-white bg-orange-500',
        'yellow' => 'text-white bg-yellow-400',
    ];

    private const array DEFAULT_BADGE_SIZES = [
        'sm' => 'px-1.5 py-0.5 text-xs',
        'md' => 'px-2.5 py-0.5 text-xs',
        'circle' => 'w-4 h-4 flex items-center justify-center p-0 text-[0.5rem]',
    ];

    private const array DEFAULT_CARD_PADDINGS = [
        'none' => '',
        'large' => ' p-8',
        'default' => ' p-4',
        'no-bottom' => ' px-4 pt-4',
    ];

    private const array DEFAULT_LINK_PREPEND_ICON_MARGINS = [
        'sm' => 'ml-1',
        'md' => 'ml-2',
        'lg' => 'ml-3',
    ];

    private const array DEFAULT_LINK_APPEND_ICON_MARGINS = [
        'sm' => 'mr-1',
        'md' => 'mr-2',
        'lg' => 'mr-3',
    ];

    private const array DEFAULT_SECTION_PADDINGS = [
        'none' => '',
        'small' => ' p-2 sm:p-3 lg:p-4',
        'small-y' => ' py-2 sm:py-3 lg:py-4',
        'large' => ' p-4 sm:p-6 lg:p-8',
        'large-y' => ' py-4 sm:py-6 lg:py-8',
    ];

    private const array DEFAULT_SUB_TITLE_FONT_SIZES = [
        'h2' => 'text-3xl',
        'h3' => 'text-2xl',
        'h4' => 'text-xl',
        'h5' => 'text-lg',
        'h6' => 'text-base',
    ];

    private const array DEFAULT_TABLE_STICKY_CELL_POSITIONS = [
        'top' => 'top-0 border-b border-b-gray-200 z-10',
        'right' => 'right-[-1px] border-l border-l-gray-200 z-10',
        'bottom' => 'bottom-0 border-t border-t-gray-200 z-10',
        'left' => 'left-0 border-r border-r-gray-200 z-10',
        'top-right' => 'top-0 border-b border-b-gray-200 right-[-1px] border-l border-l-gray-200 z-20',
    ];

    private const array DEFAULT_DROPDOWN_BADGE_TYPE = [
        'errors' => 'inline-flex items-center justify-center w-5 h-5 bg-red-100 text-red-800 text-xs rounded-full',
    ];

    private const array DEFAULT_LOGO_SIZES = [
        'sm' => 'w-6 h-6',
        'md' => 'w-10 h-10',
        'lg' => 'w-20 h-20',
    ];
}

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
        $builder->setParameter('button.variant.default', $config['button']['default_variant']);
        $builder->setParameter('button.size.default', $config['button']['default_size']);

        $builder->setParameter('icon.sizes', array_replace(self::DEFAULT_ICON_SIZES, $config['icon']['sizes']));
        $builder->setParameter('icon.size.default', $config['icon']['default_size']);

        $builder->setParameter('avatar.sizes', array_replace(self::DEFAULT_AVATAR_SIZES, $config['avatar']['sizes'] ?? []));
        $builder->setParameter('avatar.borderRadii', array_replace(self::DEFAULT_AVATAR_BORDER_RADII, $config['avatar']['border_radii'] ?? []));
        $builder->setParameter('avatar.size.default', $config['avatar']['default_size']);
        $builder->setParameter('avatar.borderRadius.default', $config['avatar']['default_border_radius']);

        $builder->setParameter('alert.types', array_replace(self::DEFAULT_ALERT_TYPES, $config['alert']['types'] ?? []));
        $builder->setParameter('alert.type.default', $config['alert']['default_type']);

        $builder->setParameter('badge.variants', array_replace(self::DEFAULT_BADGE_VARIANTS, $config['badge']['variants'] ?? []));
        $builder->setParameter('badge.sizes', array_replace(self::DEFAULT_BADGE_SIZES, $config['badge']['sizes'] ?? []));
        $builder->setParameter('badge.variant.default', $config['badge']['default_variant']);
        $builder->setParameter('badge.size.default', $config['badge']['default_size']);

        $builder->setParameter('card.paddings', array_replace(self::DEFAULT_CARD_PADDINGS, $config['card']['paddings'] ?? []));
        $builder->setParameter('card.padding.default', $config['card']['default_padding']);

        $builder->setParameter('link.prependIconMargins', array_replace(self::DEFAULT_LINK_PREPEND_ICON_MARGINS, $config['link']['prepend_icon_margins'] ?? []));
        $builder->setParameter('link.appendIconMargins', array_replace(self::DEFAULT_LINK_APPEND_ICON_MARGINS, $config['link']['append_icon_margins'] ?? []));
        $builder->setParameter('link.prependIconMargin.default', $config['link']['default_prepend_icon_margin']);
        $builder->setParameter('link.appendIconMargin.default', $config['link']['default_append_icon_margin']);

        $builder->setParameter('section.paddings', array_replace(self::DEFAULT_SECTION_PADDINGS, $config['section']['paddings'] ?? []));
        $builder->setParameter('section.padding.default', $config['section']['default_padding']);

        $builder->setParameter('sub_title.font_sizes', array_replace(self::DEFAULT_SUB_TITLE_FONT_SIZES, $config['sub_title']['font_sizes'] ?? []));
        $builder->setParameter('sub_title.font_size.default', $config['sub_title']['default_font_size']);

        $builder->setParameter('title.font_sizes', array_replace(self::DEFAULT_TITLE_FONT_SIZES, $config['title']['font_sizes'] ?? []));
        $builder->setParameter('title.font_size.default', $config['title']['default_font_size']);

        $builder->setParameter('table.sticky_cell.positions', array_replace(self::DEFAULT_TABLE_STICKY_CELL_POSITIONS, $config['table']['sticky_cell']['positions'] ?? []));
        $builder->setParameter('table.sticky_cell.position.default', $config['table']['sticky_cell']['default_position']);

        $builder->setParameter('nav.badge_type', array_replace(self::DEFAULT_DROPDOWN_BADGE_TYPE, $config['nav']['badge_type'] ?? []));
        $builder->setParameter('nav.badge_type.default', $config['nav']['default_badge_type']);

        $builder->setParameter('logo.sizes', array_replace(self::DEFAULT_LOGO_SIZES, $config['logo']['sizes'] ?? []));
        $builder->setParameter('logo.size.default', $config['logo']['default_size']);

        $builder->setParameter('modal.close.buttonVariant', $config['modal']['close']['button_variant']);
        $builder->setParameter('modal.close.buttonSize', $config['modal']['close']['button_size']);

        $builder->setParameter('modal.confirm.buttonVariant', $config['modal']['confirm']['button_variant']);
        $builder->setParameter('modal.confirm.buttonSize', $config['modal']['confirm']['button_size']);

        $builder->setParameter('modal.cancel.buttonVariant', $config['modal']['cancel']['button_variant']);
        $builder->setParameter('modal.cancel.buttonSize', $config['modal']['cancel']['button_size']);

        $builder->setParameter('indicator.variants', array_replace(self::DEFAULT_INDICATOR_VARIANTS, $config['indicator']['variants'] ?? []));
        $builder->setParameter('indicator.variant.default', $config['indicator']['default_variant']);

        $builder->setParameter('toast.types', self::mergeToastTypes($config['toast']['types'] ?? []));
        $builder->setParameter('toast.type.default', $config['toast']['default_type']);
        $builder->setParameter('toast.auto_close.default', $config['toast']['default_auto_close']);
        $builder->setParameter('toast.time_until_close.default', $config['toast']['default_time_until_close']);
    }

    public function configure(DefinitionConfigurator $definition): void
    {
        $root = $definition->rootNode();

        $root
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
            ->scalarNode('default_variant')
            ->defaultValue('primary')
            ->end()
            ->arrayNode('sizes')
            ->useAttributeAsKey('name')
            ->normalizeKeys(false)
            ->scalarPrototype()->end()
            ->defaultValue(self::DEFAULT_BUTTON_SIZES)
            ->end()
            ->scalarNode('default_size')
            ->defaultValue('md')
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
            ->scalarNode('default_size')
            ->defaultValue('md')
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
            ->scalarNode('default_size')
            ->defaultValue('md')
            ->end()
            ->scalarNode('default_border_radius')
            ->defaultValue('full')
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
            ->scalarNode('default_type')
            ->defaultValue('default')
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
            ->scalarNode('default_variant')
            ->defaultValue('primary')
            ->end()
            ->scalarNode('default_size')
            ->defaultValue('md')
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
            ->scalarNode('default_padding')
            ->defaultValue('default')
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
            ->scalarNode('default_prepend_icon_margin')
            ->defaultValue('md')
            ->end()
            ->scalarNode('default_append_icon_margin')
            ->defaultValue('md')
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
            ->scalarNode('default_padding')
            ->defaultValue('large')
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
            ->scalarNode('default_font_size')
            ->defaultValue('h2')
            ->end()
            ->end()
            ->end()

            ->arrayNode('title')
            ->addDefaultsIfNotSet()
            ->children()
            ->arrayNode('font_sizes')
            ->useAttributeAsKey('name')
            ->normalizeKeys(false)
            ->scalarPrototype()->end()
            ->defaultValue(self::DEFAULT_TITLE_FONT_SIZES)
            ->end()
            ->scalarNode('default_font_size')
            ->defaultValue('4xl')
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
            ->scalarNode('default_position')
            ->defaultValue('right')
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
            ->scalarNode('default_badge_type')
            ->defaultValue('errors')
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
            ->scalarNode('default_size')
            ->defaultValue('md')
            ->end()
            ->end()
            ->end()

            ->arrayNode('indicator')
            ->addDefaultsIfNotSet()
            ->children()
            ->arrayNode('variants')
            ->useAttributeAsKey('name')
            ->normalizeKeys(false)
            ->scalarPrototype()->end()
            ->defaultValue(self::DEFAULT_INDICATOR_VARIANTS)
            ->end()
            ->scalarNode('default_variant')
            ->defaultValue('primary')
            ->end()
            ->end()
            ->end()

            ->arrayNode('toast')
            ->addDefaultsIfNotSet()
            ->children()
            ->arrayNode('types')
            ->useAttributeAsKey('name')
            ->normalizeKeys(false)
            ->arrayPrototype()
            ->children()
            ->scalarNode('classes')->defaultNull()->end()
            ->scalarNode('icon')->defaultNull()->end()
            ->scalarNode('close_button_variant')->defaultNull()->end()
            ->scalarNode('close_button_size')->defaultNull()->end()
            ->end()
            ->end()
            ->defaultValue(self::DEFAULT_TOAST_TYPES)
            ->end()
            ->scalarNode('default_type')
            ->defaultValue('success')
            ->end()
            ->booleanNode('default_auto_close')
            ->defaultTrue()
            ->end()
            ->integerNode('default_time_until_close')
            ->defaultValue(10000)
            ->end()
            ->end()
            ->end()

            ->arrayNode('modal')
            ->addDefaultsIfNotSet()
            ->children()
            ->arrayNode('close')
            ->addDefaultsIfNotSet()
            ->children()
            ->scalarNode('button_variant')
            ->defaultValue('hollow')
            ->end()
            ->scalarNode('button_size')
            ->defaultValue('md')
            ->end()
            ->end()
            ->end()
            ->arrayNode('confirm')
            ->addDefaultsIfNotSet()
            ->children()
            ->scalarNode('button_variant')
            ->defaultValue('primary')
            ->end()
            ->scalarNode('button_size')
            ->defaultValue('md')
            ->end()
            ->end()
            ->end()
            ->arrayNode('cancel')
            ->addDefaultsIfNotSet()
            ->children()
            ->scalarNode('button_variant')
            ->defaultValue('hollow')
            ->end()
            ->scalarNode('button_size')
            ->defaultValue('md')
            ->end()
            ->end()
            ->end()
            ->end()
            ->end()
            ->end();

        $root
            ->validate()
            ->always(function ($config) {
                # button
                self::assertDefaultInKeys('button', 'default_variant', 'variants', $config['button']['default_variant'],
                    array_replace(self::DEFAULT_BUTTON_VARIANTS, $config['button']['variants']));
                self::assertDefaultInKeys('button', 'default_size', 'sizes', $config['button']['default_size'],
                    array_replace(self::DEFAULT_BUTTON_SIZES, $config['button']['sizes']));

                # icon
                self::assertDefaultInKeys('icon', 'default_size', 'sizes', $config['icon']['default_size'],
                    array_replace(self::DEFAULT_ICON_SIZES, $config['icon']['sizes']));

                # avatar
                self::assertDefaultInKeys('avatar', 'default_size', 'sizes', $config['avatar']['default_size'],
                    array_replace(self::DEFAULT_AVATAR_SIZES, $config['avatar']['sizes']));
                self::assertDefaultInKeys('avatar', 'default_border_radius', 'border_radii', $config['avatar']['default_border_radius'],
                    array_replace(self::DEFAULT_AVATAR_BORDER_RADII, $config['avatar']['border_radii']));

                # alert
                self::assertDefaultInKeys('alert', 'default_type', 'types', $config['alert']['default_type'],
                    array_replace(self::DEFAULT_ALERT_TYPES, $config['alert']['types']));

                # badge
                self::assertDefaultInKeys('badge', 'default_variant', 'variants', $config['badge']['default_variant'],
                    array_replace(self::DEFAULT_BADGE_VARIANTS, $config['badge']['variants']));
                self::assertDefaultInKeys('badge', 'default_size', 'sizes', $config['badge']['default_size'],
                    array_replace(self::DEFAULT_BADGE_SIZES, $config['badge']['sizes']));

                # card
                self::assertDefaultInKeys('card', 'default_padding', 'paddings', $config['card']['default_padding'],
                    array_replace(self::DEFAULT_CARD_PADDINGS, $config['card']['paddings']));

                # link
                self::assertDefaultInKeys('link', 'default_prepend_icon_margin', 'prepend_icon_margins', $config['link']['default_prepend_icon_margin'],
                    array_replace(self::DEFAULT_LINK_PREPEND_ICON_MARGINS, $config['link']['prepend_icon_margins']));
                self::assertDefaultInKeys('link', 'default_append_icon_margin', 'append_icon_margins', $config['link']['default_append_icon_margin'],
                    array_replace(self::DEFAULT_LINK_APPEND_ICON_MARGINS, $config['link']['append_icon_margins']));

                # section
                self::assertDefaultInKeys('section', 'default_padding', 'paddings', $config['section']['default_padding'],
                    array_replace(self::DEFAULT_SECTION_PADDINGS, $config['section']['paddings']));

                # sub_title
                self::assertDefaultInKeys('sub_title', 'default_font_size', 'font_sizes', $config['sub_title']['default_font_size'],
                    array_replace(self::DEFAULT_SUB_TITLE_FONT_SIZES, $config['sub_title']['font_sizes']));

                # title
                self::assertDefaultInKeys('title', 'default_font_size', 'font_sizes', $config['title']['default_font_size'],
                    array_replace(self::DEFAULT_TITLE_FONT_SIZES, $config['title']['font_sizes']));

                # table.sticky_cell
                self::assertDefaultInKeys('table.sticky_cell', 'default_position', 'positions', $config['table']['sticky_cell']['default_position'],
                    array_replace(self::DEFAULT_TABLE_STICKY_CELL_POSITIONS, $config['table']['sticky_cell']['positions']));

                # nav
                self::assertDefaultInKeys('nav', 'default_badge_type', 'badge_type', $config['nav']['default_badge_type'],
                    array_replace(self::DEFAULT_DROPDOWN_BADGE_TYPE, $config['nav']['badge_type']));

                # logo
                self::assertDefaultInKeys('logo', 'default_size', 'sizes', $config['logo']['default_size'],
                    array_replace(self::DEFAULT_LOGO_SIZES, $config['logo']['sizes']));

                # indicator
                self::assertDefaultInKeys('indicator', 'default_variant', 'variants', $config['indicator']['default_variant'],
                    array_replace(self::DEFAULT_INDICATOR_VARIANTS, $config['indicator']['variants']));

                # toast
                $toastTypes = self::mergeToastTypes($config['toast']['types']);
                self::assertDefaultInKeys('toast', 'default_type', 'types', $config['toast']['default_type'], $toastTypes);

                # toast: cross-reference close button variants/sizes against merged button config
                foreach ($toastTypes as $name => $type) {
                    if (!array_key_exists($type['close_button_variant'], array_replace(self::DEFAULT_BUTTON_VARIANTS, $config['button']['variants']))) {
                        throw new \InvalidArgumentException(sprintf(
                            'toast.types.%s.close_button_variant "%s" must be one of the button variants. Available: %s.',
                            $name, $type['close_button_variant'],
                            implode(', ', array_keys(array_replace(self::DEFAULT_BUTTON_VARIANTS, $config['button']['variants'])))
                        ));
                    }
                    if (!array_key_exists($type['close_button_size'], array_replace(self::DEFAULT_BUTTON_SIZES, $config['button']['sizes']))) {
                        throw new \InvalidArgumentException(sprintf(
                            'toast.types.%s.close_button_size "%s" must be one of the button sizes. Available: %s.',
                            $name, $type['close_button_size'],
                            implode(', ', array_keys(array_replace(self::DEFAULT_BUTTON_SIZES, $config['button']['sizes'])))
                        ));
                    }
                }

                # modal: cross-reference against merged button variants/sizes
                $buttonVariants = array_replace(self::DEFAULT_BUTTON_VARIANTS, $config['button']['variants']);
                $buttonSizes = array_replace(self::DEFAULT_BUTTON_SIZES, $config['button']['sizes']);
                foreach (['close', 'confirm', 'cancel'] as $action) {
                    if (!array_key_exists($config['modal'][$action]['button_variant'], $buttonVariants)) {
                        throw new \InvalidArgumentException(sprintf(
                            'modal.%s.button_variant "%s" must be one of the button variants. Available: %s.',
                            $action, $config['modal'][$action]['button_variant'], implode(', ', array_keys($buttonVariants))
                        ));
                    }
                    if (!array_key_exists($config['modal'][$action]['button_size'], $buttonSizes)) {
                        throw new \InvalidArgumentException(sprintf(
                            'modal.%s.button_size "%s" must be one of the button sizes. Available: %s.',
                            $action, $config['modal'][$action]['button_size'], implode(', ', array_keys($buttonSizes))
                        ));
                    }
                }

                return $config;
            })
            ->end();
    }

    private static function mergeToastTypes(array $types): array
    {
        $merged = self::DEFAULT_TOAST_TYPES;

        foreach ($types as $name => $type) {
            $merged[$name] = array_replace(
                $merged[$name] ?? self::TOAST_TYPE_FALLBACK,
                array_filter($type, static fn ($value) => null !== $value)
            );
        }

        return $merged;
    }

    private static function assertDefaultInKeys(string $section, string $defaultKey, string $arrayKey, string $defaultValue, array $mergedKeys): void
    {
        if (!array_key_exists($defaultValue, $mergedKeys)) {
            throw new \InvalidArgumentException(sprintf(
                '%s."%s" "%s" must be a key in "%s". Available: %s.',
                $section,
                $defaultKey,
                $defaultValue,
                $arrayKey,
                implode(', ', array_keys($mergedKeys))
            ));
        }
    }

    private const array DEFAULT_BUTTON_VARIANTS = [
        'primary' => 'text-white fill-white bg-tbd-blue hover:bg-tbd-blue-dark',
        'tab' => '!rounded-none !px-0 text-tbd-ink-muted hover:text-tbd-ink pb-2 border-b-2 border-transparent',
        'tab-active' => '!rounded-none !px-0 text-tbd-ink pb-2 border-b-2 border-tbd-accent',
        'hollow' => 'text-tbd-ink fill-tbd-ink border border-tbd-line hover:bg-tbd-tint hover:text-tbd-accent-strong hover:fill-tbd-accent-strong',
        'hollow-error' => 'text-tbd-danger-ink font-bold border-transparent hover:underline',
        'hollow-success' => 'text-tbd-success-ink font-bold border-transparent hover:underline',
        'multi-level' => 'w-full !text-base !font-normal rounded-none hover:bg-tbd-tint',
        'white' => 'text-tbd-ink fill-tbd-ink hover:text-tbd-accent-strong hover:fill-tbd-accent-strong',
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
        'error' => 'border-tbd-danger-line bg-tbd-danger-soft text-tbd-danger-ink',
        'success' => 'border-tbd-success-line bg-tbd-success-soft text-tbd-success-ink',
        'warning' => 'border-tbd-warning-line bg-tbd-warning-soft text-tbd-warning-ink',
        'default' => 'border-tbd-line bg-tbd-surface text-tbd-ink',
    ];

    private const array DEFAULT_BADGE_VARIANTS = [
        'primary' => 'border border-transparent bg-tbd-accent/15 text-tbd-accent-strong',
        'gray' => 'border border-transparent bg-tbd-tint-strong text-tbd-ink',
        'green' => 'border border-tbd-success-line bg-tbd-success-soft text-tbd-success-ink',
        'red' => 'border border-tbd-danger-line bg-tbd-danger-soft text-tbd-danger-ink',
        'gold' => 'border border-transparent bg-tbd-gold/20 text-tbd-gold-ink',
        'yellow' => 'border border-tbd-warning-line bg-tbd-warning-soft text-tbd-warning-ink',
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

    private const array DEFAULT_TITLE_FONT_SIZES = [
        'xl' => 'text-base lg:text-xl',
        '2xl' => 'text-lg lg:text-2xl',
        '3xl' => 'text-xl lg:text-3xl',
        '4xl' => 'text-2xl lg:text-4xl',
        '5xl' => 'text-3xl lg:text-5xl',
        '6xl' => 'text-4xl lg:text-6xl',
    ];

    private const array DEFAULT_SUB_TITLE_FONT_SIZES = [
        'h2' => 'text-3xl',
        'h3' => 'text-2xl',
        'h4' => 'text-xl',
        'h5' => 'text-lg',
        'h6' => 'text-base',
    ];

    private const array DEFAULT_TABLE_STICKY_CELL_POSITIONS = [
        'top' => 'top-0 border-b border-b-tbd-line z-10',
        'right' => 'right-[-1px] border-l border-l-tbd-line z-10',
        'bottom' => 'bottom-0 border-t border-t-tbd-line z-10',
        'left' => 'left-0 border-r border-r-tbd-line z-10',
        'top-right' => 'top-0 border-b border-b-tbd-line right-[-1px] border-l border-l-tbd-line z-20',
    ];

    private const array DEFAULT_DROPDOWN_BADGE_TYPE = [
        'errors' => 'inline-flex items-center justify-center w-5 h-5 bg-tbd-danger-soft text-tbd-danger-ink text-xs rounded-full',
    ];

    private const array TOAST_TYPE_FALLBACK = [
        'classes' => '',
        'icon' => 'circle-check',
        'close_button_variant' => 'hollow',
        'close_button_size' => 'sm',
    ];

    private const array DEFAULT_TOAST_TYPES = [
        'success' => [
            'classes' => '!border-tbd-success-line !bg-tbd-success-soft text-tbd-success-ink',
            'icon' => 'circle-check',
            'close_button_variant' => 'hollow-success',
            'close_button_size' => 'sm',
        ],
        'error' => [
            'classes' => '!border-tbd-danger-line !bg-tbd-danger-soft text-tbd-danger-ink',
            'icon' => 'circle-xmark',
            'close_button_variant' => 'hollow-error',
            'close_button_size' => 'sm',
        ],
    ];

    private const array DEFAULT_INDICATOR_VARIANTS = [
        'primary' => 'text-tbd-on-accent bg-tbd-accent group-focus:bg-tbd-accent-strong',
    ];
    private const array DEFAULT_LOGO_SIZES = [
        'sm' => 'h-6 w-auto',
        'md' => 'h-10 w-auto',
        'lg' => 'h-20 w-auto',
    ];
}

<?php

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Tbd\TwigComponentBundle\Twig\Components\TBD\Alert;
use Tbd\TwigComponentBundle\Twig\Components\TBD\Avatar;
use Tbd\TwigComponentBundle\Twig\Components\TBD\Badge;
use Tbd\TwigComponentBundle\Twig\Components\TBD\Button;
use Tbd\TwigComponentBundle\Twig\Components\TBD\Card;
use Tbd\TwigComponentBundle\Twig\Components\TBD\Link;
use Tbd\TwigComponentBundle\Twig\Components\TBD\Logo;
use Tbd\TwigComponentBundle\Twig\Components\TBD\Modal\Confirm;
use Tbd\TwigComponentBundle\Twig\Components\TBD\Modal\Delete;
use Tbd\TwigComponentBundle\Twig\Components\TBD\Modal\Source;
use Tbd\TwigComponentBundle\Twig\Components\TBD\Nav\Dropdown as NavDropdown;
use Tbd\TwigComponentBundle\Twig\Components\TBD\Nav\Item;
use Tbd\TwigComponentBundle\Twig\Components\TBD\Navbar;
use Tbd\TwigComponentBundle\Twig\Components\TBD\Section;
use Tbd\TwigComponentBundle\Twig\Components\TBD\Select;
use Tbd\TwigComponentBundle\Twig\Components\TBD\Spinner;
use Tbd\TwigComponentBundle\Twig\Components\TBD\SubTitle;
use Tbd\TwigComponentBundle\Twig\Components\TBD\Table\StickyCell;
use Tbd\TwigComponentBundle\Twig\Components\TBD\Title;
use Tbd\TwigComponentBundle\Twig\Components\TBD\Toast;

return static function (ContainerConfigurator $configurator): void {
    $services = $configurator->services()
        ->defaults()
        ->autowire()
        ->autoconfigure();

    $services
        ->load('Tbd\\TwigComponentBundle\\', __DIR__ . '/../src/')
        ->exclude([
            __DIR__ . '/../src/TbdTwigComponentBundle.php',
        ]);

    # Write variables to the component constructors
    $services
        ->set(Button::class)
        ->args([
            '$variants' => '%button.variants%',
            '$defaultVariant' => '%button.variant.default%',
            '$sizes' => '%button.sizes%',
            '$defaultSize' => '%button.size.default%',
            '$iconSizes' => '%icon.sizes%',
        ])
        ->set(Spinner::class)
        ->args([
            '$sizes' => '%icon.sizes%',
            '$defaultSize' => '%icon.size.default%',
        ])
        ->set(Avatar::class)
        ->args([
            '$sizes' => '%avatar.sizes%',
            '$borderRadii' => '%avatar.borderRadii%',
            '$defaultSize' => '%avatar.size.default%',
            '$defaultBorderRadius' => '%avatar.borderRadius.default%',
        ])
        ->set(Alert::class)
        ->args([
            '$types' => '%alert.types%',
            '$defaultType' => '%alert.type.default%',
        ])
        ->set(Badge::class)
        ->args([
            '$variants' => '%badge.variants%',
            '$sizes' => '%badge.sizes%',
            '$defaultVariant' => '%badge.variant.default%',
            '$defaultSize' => '%badge.size.default%',
        ])
        ->set(Card::class)
        ->args([
            '$paddings' => '%card.paddings%',
            '$defaultPadding' => '%card.padding.default%',
        ])
        ->set(Link::class)
        ->args([
            '$iconSizes' => '%icon.sizes%',
            '$prependIconMargins' => '%link.prependIconMargins%',
            '$appendIconMargins' => '%link.appendIconMargins%',
            '$defaultIconSize' => '%icon.size.default%',
        ])
        ->set(Section::class)
        ->args([
            '$paddings' => '%section.paddings%',
            '$defaultPadding' => '%section.padding.default%',
        ])
        ->set(SubTitle::class)
        ->args([
            '$fontSizes' => '%sub_title.font_sizes%',
            '$defaultTag' => '%sub_title.font_size.default%',
        ])
        ->set(Title::class)
        ->args([
            '$fontSizes' => '%title.font_sizes%',
            '$defaultFontSize' => '%title.font_size.default%',
        ])
        ->set(StickyCell::class)
        ->args([
            '$positions' => '%table.sticky_cell.positions%',
            '$defaultPosition' => '%table.sticky_cell.position.default%',
        ])
        ->set(Toast::class)
        ->args([
            '$iconSizes' => '%icon.sizes%',
            '$defaultIconSize' => '%icon.size.default%',
        ])
        ->set(NavDropdown::class)
        ->args([
            '$badgeTypes' => '%nav.badge_type%',
            '$defaultBadgeType' => '%nav.badge_type.default%',
        ])
        ->set(Item::class)
        ->args([
            '$badgeTypes' => '%nav.badge_type%',
            '$defaultBadgeType' => '%nav.badge_type.default%',
        ])
        ->set(NavDropdown\Item::class)
        ->args([
            '$badgeTypes' => '%nav.badge_type%',
            '$defaultBadgeType' => '%nav.badge_type.default%',
        ])
        ->set(Navbar::class)
        ->args([
            '$variants' => '%button.variants%',
            '$sizes' => '%button.sizes%',
        ])
        ->set(Logo::class)
        ->args([
            '$sizes' => '%logo.sizes%',
            '$defaultSize' => '%logo.size.default%',
        ])
        ->set(Source::class)
        ->args([
            '$closeButtonVariant' => '%modal.close.buttonVariant%',
            '$closeButtonSize' => '%modal.close.buttonSize%',
        ])
        ->set(Confirm::class)
        ->args([
            '$closeButtonVariant' => '%modal.close.buttonVariant%',
            '$closeButtonSize' => '%modal.close.buttonSize%',
            '$confirmButtonVariant' => '%modal.confirm.buttonVariant%',
            '$confirmButtonSize' => '%modal.confirm.buttonSize%',
            '$cancelButtonVariant' => '%modal.cancel.buttonVariant%',
            '$cancelButtonSize' => '%modal.cancel.buttonSize%',
        ])
        ->set(Delete::class)
        ->args([
            '$closeButtonVariant' => '%modal.close.buttonVariant%',
            '$closeButtonSize' => '%modal.close.buttonSize%',
            '$confirmButtonVariant' => '%modal.confirm.buttonVariant%',
            '$confirmButtonSize' => '%modal.confirm.buttonSize%',
            '$cancelButtonVariant' => '%modal.cancel.buttonVariant%',
            '$cancelButtonSize' => '%modal.cancel.buttonSize%',
        ])
        ->set(Select::class)
        ->args([
            '$variants' => '%button.variants%',
        ])
    ;
};

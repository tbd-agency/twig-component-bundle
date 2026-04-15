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
use Tbd\TwigComponentBundle\Twig\Components\TBD\Modal\Form;
use Tbd\TwigComponentBundle\Twig\Components\TBD\Nav\Dropdown as NavDropdown;
use Tbd\TwigComponentBundle\Twig\Components\TBD\Nav\Item;
use Tbd\TwigComponentBundle\Twig\Components\TBD\Navbar;
use Tbd\TwigComponentBundle\Twig\Components\TBD\Section;
use Tbd\TwigComponentBundle\Twig\Components\TBD\Spinner;
use Tbd\TwigComponentBundle\Twig\Components\TBD\SubTitle;
use Tbd\TwigComponentBundle\Twig\Components\TBD\Table\StickyCell;
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
        ])
        ->set(Avatar::class)
        ->args([
            '$sizes' => '%avatar.sizes%',
            '$borderRadii' => '%avatar.borderRadii%',
        ])
        ->set(Alert::class)
        ->args([
            '$types' => '%alert.types%',
        ])
        ->set(Badge::class)
        ->args([
            '$variants' => '%badge.variants%',
            '$sizes' => '%badge.sizes%',
        ])
        ->set(Card::class)
        ->args([
            '$paddings' => '%card.paddings%',
        ])
        ->set(Link::class)
        ->args([
            '$iconSizes' => '%icon.sizes%',
            '$prependIconMargins' => '%link.prependIconMargins%',
            '$appendIconMargins' => '%link.appendIconMargins%',
        ])
        ->set(Section::class)
        ->args([
            '$paddings' => '%section.paddings%',
        ])
        ->set(SubTitle::class)
        ->args([
            '$fontSizes' => '%sub_title.font_sizes%',
        ])
        ->set(StickyCell::class)
        ->args([
            '$positions' => '%table.sticky_cell.positions%',
        ])
        ->set(Toast::class)
        ->args([
            '$iconSizes' => '%icon.sizes%',
        ])
        ->set(NavDropdown::class)
        ->args([
            '$badgeTypes' => '%nav.badge_type%'
        ])
        ->set(Item::class)
        ->args([
            '$badgeTypes' => '%nav.badge_type%'
        ])
        ->set(NavDropdown\Item::class)
        ->args([
            '$badgeTypes' => '%nav.badge_type%'
        ])
        ->set(Navbar::class)
        ->args([
            '$variants' => '%button.variants%',
            '$sizes' => '%button.sizes%',
        ])
        ->set(Logo::class)
        ->args([
            '$sizes' => '%logo.sizes%',
        ])
        ->set(Form::class)
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
        ]);
};

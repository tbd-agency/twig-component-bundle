<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD\Nav\SubNav;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(
    name: 'TBD:Nav:SubNav:Item',
    template: '@TbdTwigComponent/components/TBD/Nav/SubNav/Item.html.twig')]
final class Item
{
    public ?string $label = null;
    public ?string $path = null;
}

<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD\Table;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(
    name: 'TBD:Table:Row',
    template: '@TbdTwigComponent/components/TBD/Table/Row.html.twig')]
final class Row
{
    public ?string $path = null;
    public ?string $permission = null;
}

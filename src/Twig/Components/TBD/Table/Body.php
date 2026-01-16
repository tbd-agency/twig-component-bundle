<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD\Table;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(
    name: 'TBD:Table:Body',
    template: '@TbdTwigComponent/components/TBD/Table/Body.html.twig')]
final class Body
{
}

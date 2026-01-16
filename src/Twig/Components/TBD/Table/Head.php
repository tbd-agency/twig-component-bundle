<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD\Table;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(
    name: 'TBD:Table:Head',
    template: '@TbdTwigComponent/components/TBD/Table/Head.html.twig')]
final class Head
{
}

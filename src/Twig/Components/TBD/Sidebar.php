<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(
    name: 'TBD:Sidebar',
    template: '@TbdTwigComponent/components/TBD/Sidebar.html.twig')]
final class Sidebar
{
}

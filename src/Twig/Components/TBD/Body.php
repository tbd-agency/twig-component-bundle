<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(
    name: 'TBD:Body',
    template: '@TbdTwigComponent/components/TBD/Body.html.twig')]
final class Body
{
    public bool $delete = true;
    public bool $sidebar = true;
    public bool $modal = true;
    public bool $url = true;
    public bool $sidebarHoverState = false;
}

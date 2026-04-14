<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD\Table;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(
    name: 'TBD:Table:Wrapper',
    template: '@TbdTwigComponent/components/TBD/Table/Wrapper.html.twig')]
final class Wrapper
{
    public bool $hasSearch = false;
    public bool $hasTabs = false;
    public bool $isSticky = false;
}

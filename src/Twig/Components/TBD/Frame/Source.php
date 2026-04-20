<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD\Frame;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(
    name: 'TBD:Frame:Source',
    template: '@TbdTwigComponent/components/TBD/Frame/Source.html.twig')]
final class Source
{
    public ?string $id = 'source-frame';
    public ?string $src = null;
}

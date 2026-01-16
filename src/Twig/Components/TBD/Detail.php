<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(
    name: 'TBD:Detail',
    template: '@TbdTwigComponent/components/TBD/Detail.html.twig')]
final class Detail
{
    public string $label;
    public mixed $value;
}

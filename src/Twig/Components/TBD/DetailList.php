<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(
    name: 'TBD:DetailList',
    template: '@TbdTwigComponent/components/TBD/DetailList.html.twig')]
final class DetailList
{
    public string $label;
    public mixed $value;
}

<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(
    name: 'TBD:Checkbox',
    template: '@TbdTwigComponent/components/TBD/Checkbox.html.twig')]
final class Checkbox
{
}

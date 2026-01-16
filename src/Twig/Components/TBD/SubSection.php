<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(
    name: 'TBD:SubSection',
    template: '@TbdTwigComponent/components/TBD/SubSection.html.twig')]
final class SubSection
{
}

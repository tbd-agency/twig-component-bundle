<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(
    name: 'TBD:Html',
    template: '@TbdTwigComponent/components/TBD/Html.html.twig')]
final class Html
{
    public ?string $lang = null;
}

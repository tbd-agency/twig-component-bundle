<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD\Form;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(
    name: 'TBD:Form:Search',
    template: '@TbdTwigComponent/components/TBD/Form/Search.html.twig')]
final class Search
{
}

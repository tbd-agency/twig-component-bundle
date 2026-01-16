<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD\Dropdown;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(
    name: 'TBD:Dropdown:UnorderedList',
    template: '@TbdTwigComponent/components/TBD/Dropdown/UnorderedList.html.twig')]
final class UnorderedList
{
}

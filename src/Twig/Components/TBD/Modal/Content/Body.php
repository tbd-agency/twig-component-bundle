<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD\Modal\Content;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(
    name: 'TBD:Modal:Content:Body',
    template: '@TbdTwigComponent/components/TBD/Modal/Content/Body.html.twig')]
final class Body
{
}

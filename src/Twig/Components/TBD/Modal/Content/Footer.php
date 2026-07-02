<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD\Modal\Content;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(
    name: 'TBD:Modal:Content:Footer',
    template: '@TbdTwigComponent/components/TBD/Modal/Content/Footer.html.twig')]
final class Footer
{
}

<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD\Modal;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(
    name: 'TBD:Modal:Delete',
    template: '@TbdTwigComponent/components/TBD/Modal/Delete.html.twig')]
final class Delete extends AbstractController
{
    public ?string $title = null;
    public ?string $message = null;
}

<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD\Modal;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(
    name: 'TBD:Modal:Confirm',
    template: '@TbdTwigComponent/components/TBD/Modal/Confirm.html.twig')]
final class Confirm extends AbstractController
{
    public ?string $id = 'modal-confirm';
    public ?string $title = null;
    public ?string $message = null;
}

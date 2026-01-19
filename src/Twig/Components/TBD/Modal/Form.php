<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD\Modal;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(
    name: 'TBD:Modal:Form',
    template: '@TbdTwigComponent/components/TBD/Modal/Form.html.twig')]
final class Form
{
    public string $modalId = 'form-modal';
    public string $frameId = 'form-frame';
    public ?string $title = null;
    public ?string $src = null;
}

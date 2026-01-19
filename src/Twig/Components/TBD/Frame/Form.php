<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD\Frame;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(
    name: 'TBD:Frame:Form',
    template: '@TbdTwigComponent/components/TBD/Frame/Form.html.twig')]
final class Form
{
    public ?string $id = 'form-frame';
    public ?string $src = null;
}

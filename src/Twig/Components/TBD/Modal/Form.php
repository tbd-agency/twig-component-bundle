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
    public string $closeButtonVariant;
    public string $closeButtonSize;

    public function __construct(
        string $closeButtonVariant,
        string $closeButtonSize,
    ) {
        $this->closeButtonVariant = $closeButtonVariant;
        $this->closeButtonSize = $closeButtonSize;
    }
}

<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD\Modal;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(
    name: 'TBD:Modal:Source',
    template: '@TbdTwigComponent/components/TBD/Modal/Source.html.twig')]
final class Source
{
    public string $modalId = 'source-modal';
    public string $frameId = 'source-frame';
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

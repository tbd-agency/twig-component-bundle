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
    public ?string $confirmButtonLabel = null;
    public ?string $cancelButtonLabel = null;
    public string $closeButtonVariant;
    public string $closeButtonSize;
    public string $confirmButtonVariant;
    public string $confirmButtonSize;
    public string $cancelButtonVariant;
    public string $cancelButtonSize;

    public function __construct(
        string $closeButtonVariant,
        string $closeButtonSize,
        string $confirmButtonVariant,
        string $confirmButtonSize,
        string $cancelButtonVariant,
        string $cancelButtonSize,
    ) {
        $this->closeButtonVariant = $closeButtonVariant;
        $this->closeButtonSize = $closeButtonSize;
        $this->confirmButtonVariant = $confirmButtonVariant;
        $this->confirmButtonSize = $confirmButtonSize;
        $this->cancelButtonVariant = $cancelButtonVariant;
        $this->cancelButtonSize = $cancelButtonSize;
    }
}

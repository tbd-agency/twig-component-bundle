<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD\Select\Dropdown;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PostMount;

#[AsTwigComponent(
    name: 'TBD:Select:Dropdown:Item',
    template: '@TbdTwigComponent/components/TBD/Select/Dropdown/Item.html.twig')]
final class Item
{
    public string $action;
    public string $label;
    public string $target = '_self';
    public bool $turbo = false;
    public array $attributes = [];

    public bool $modal = false;
    public string $modalId = 'source-modal';
    public string $modalSize = 'md';
    public ?string $modalSrc = null;
    public ?string $modalTitle = null;
    public bool $confirm = false;

    #[PostMount]
    public function postMount(): void
    {
        if ($this->modalId && $this->modalSrc && $this->modalTitle) {
            $this->modal = true;
            $this->attributes = [
                'data-action' => 'click->modal#setSrc click->app#dropdownClose modal:setSrc@document->select-items#handle',
                'data-target' => $this->modalId,
                'data-src' => $this->modalSrc,
                'data-title' => $this->modalTitle,
                'data-size' => $this->modalSize,
            ];
        } else {
            $this->attributes = [
                'data-action' => 'click->select-items#handle click->app#dropdownClose',
            ];
        }
    }
}

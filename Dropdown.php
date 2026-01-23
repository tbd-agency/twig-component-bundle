<?php


use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
final class Dropdown
{
    public UuidInterface $uuid;
    public string $buttonVariant = 'hollow';
    public string $buttonSize = 'sm';
    public string $buttonIcon = 'solid:ellipsis';
    public string $buttonText = '';
    public string $buttonTooltip = '';
    public string $buttonBadge = '';
    public string $buttonClasses = '';
    public string $dropdownClasses = '';
    public string $dropdownTrigger = 'click';
    public string $dropdownPlacement = 'bottom-end';

    public function mount(): void
    {
        $this->uuid = Uuid::uuid4();
    }
}

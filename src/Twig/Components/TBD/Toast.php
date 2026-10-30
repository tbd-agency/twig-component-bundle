<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PreMount;
use function str_contains;
use Twig\Markup;

#[AsTwigComponent(
    name: 'TBD:Toast',
    template: '@TbdTwigComponent/components/TBD/Toast.html.twig')]
final class Toast
{
    public string $type;
    public string|Markup|null $message = null;
    public bool $autoClose;
    public int $timeUntilClose;
    public string $iconSize;
    public ?string $icon = null;
    public ?string $closeButtonVariant = null;
    public ?string $closeButtonSize = null;

    public function __construct(
        private readonly array $types,
        private readonly string $defaultType,
        private readonly array $iconSizes,
        private readonly string $defaultIconSize,
        private readonly bool $defaultAutoClose,
        private readonly int $defaultTimeUntilClose,
    )
    {
    }

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();

        $resolver
            ->setIgnoreUndefined()
            ->setDefaults([
                'type' => $this->defaultType,
                'iconSize' => $this->defaultIconSize,
                'autoClose' => $this->defaultAutoClose,
                'timeUntilClose' => $this->defaultTimeUntilClose,
            ])
            ->setAllowedValues('type', array_keys($this->types))
            ->setAllowedValues('iconSize', array_keys($this->iconSizes))
            ->setAllowedValues('autoClose', [true, false]);

        return $resolver->resolve($data) + $data;
    }

    public function getIconSizeClasses(): string
    {
        return $this->iconSizes[$this->iconSize];
    }

    public function getIcon(): string
    {
        $icon = $this->icon ?? $this->types[$this->type]['icon'];

        if (str_contains($icon, ':')) {
            return $icon;
        }

        return 'tbd:' . $icon;
    }

    public function getColorClasses(): string
    {
        return $this->types[$this->type]['classes'];
    }

    public function getCloseButtonVariant(): string
    {
        return $this->closeButtonVariant ?? $this->types[$this->type]['close_button_variant'];
    }

    public function getCloseButtonSize(): string
    {
        return $this->closeButtonSize ?? $this->types[$this->type]['close_button_size'];
    }
}

<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD;

use Ramsey\Uuid\Uuid;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PostMount;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent(
    name: 'TBD:Button',
    template: '@TbdTwigComponent/components/TBD/Button.html.twig')]
final class Button
{
    public ?string $icon = null;
    public ?string $indicator = null;
    public ?string $target = null;
    public ?string $tooltip = null;
    public bool $disabled;
    public bool $fullWidth;
    public bool $spinner;
    public string $extraClasses = '';
    public string $identifier;
    public string $label;
    public string $size;
    public string $tag;
    public string $type;
    public string $variant;
    public string $iconSize;

    public function __construct(
        private readonly array $variants,
        private readonly array $sizes,
        private readonly array $iconSizes,
        private readonly string $defaultVariant,
        private readonly string $defaultSize,
    ) {
    }

    public function getVariantClasses(): string
    {
        return $this->variants[$this->variant];
    }

    public function getSizeClasses(): string
    {
        return $this->sizes[$this->size];
    }

    public function getIconSizeClasses(): string
    {
        return $this->iconSizes[$this->iconSize];
    }

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();

        $resolver
            ->setIgnoreUndefined()
            ->setDefaults([
                'variant' => $this->defaultVariant,
                'size' => $this->defaultSize,
                'iconSize' => 'md',
                'type' => 'button',
                'tag' => 'button',
                'disabled' => false,
                'fullWidth' => false,
                'spinner' => false,
            ])
            ->setAllowedValues('variant', array_keys($this->variants))
            ->setAllowedValues('size', array_keys($this->sizes))
            ->setAllowedValues('iconSize', array_keys($this->iconSizes))
            ->setAllowedValues('type', ['submit', 'reset', 'button'])
            ->setAllowedValues('tag', ['button', 'a'])
            ->setAllowedValues('disabled', [true, false])
            ->setAllowedValues('fullWidth', [true, false])
            ->setAllowedValues('spinner', [true, false]);

        return $resolver->resolve($data) + $data;
    }

    public function mount(): void
    {
        $this->identifier = Uuid::uuid4()->toString();
    }

    #[PostMount]
    public function postMount(): void
    {
        $classes = [];

        if ($this->extraClasses) {
            $classes[] = $this->extraClasses;
        }
        if ($this->fullWidth) {
            $classes[] = 'w-full';
        }
        if ($this->spinner) {
            $classes[] = 'group-[[busy]]:opacity-50';
        }
        if ($this->disabled) {
            $classes[] = 'opacity-50';
        }

        $classes[] = $this->getVariantClasses();
        $classes[] = $this->getSizeClasses();

        $this->extraClasses = implode(' ', array_filter($classes));
    }
}

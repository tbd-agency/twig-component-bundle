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
    )
    {
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
        $resolver->setIgnoreUndefined();

        $resolver->setDefaults([
            'variant' => 'primary',
            'size' => 'md',
            'iconSize' => 'md',
            'type' => 'submit',
            'tag' => 'button',
            'disabled' => false,
            'fullWidth' => false,
            'spinner' => false,
        ]);

        $resolver->setAllowedValues('variant', array_keys($this->variants));
        $resolver->setAllowedValues('size', array_keys($this->sizes));
        $resolver->setAllowedValues('iconSize', array_keys($this->iconSizes));
        $resolver->setAllowedValues('type', ['submit', 'reset', 'button']);
        $resolver->setAllowedValues('tag', ['button', 'a']);
        $resolver->setAllowedValues('disabled', [true, false]);
        $resolver->setAllowedValues('fullWidth', [true, false]);
        $resolver->setAllowedValues('spinner', [true, false]);

        return $resolver->resolve($data) + $data;
    }

    public function mount(): void
    {
        $this->identifier = Uuid::uuid4()->toString();
    }

    #[PostMount]
    public function postMount(): void
    {
        $this->extraClasses = $this->fullWidth ? 'w-full' : '';
        $this->extraClasses .= $this->spinner ? ' group-[[busy]]:opacity-50' : '';
        $this->extraClasses .= $this->disabled ? ' opacity-50' : '';
        $this->extraClasses .= ' ' . $this->getVariantClasses();
        $this->extraClasses .= ' ' . $this->getSizeClasses();
    }
}

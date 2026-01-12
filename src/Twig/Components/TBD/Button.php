<?php

namespace Tbd\TbdComponentBundle\Twig\Components\TBD;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PostMount;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent(
    name: 'TBD:Button',
    template: '@TbdComponent/components/TBD/Button.html.twig')]
final class Button
{
    public ?string $indicator = null;
    public bool $disabled = false;
    public string $extraClasses = '';
    public bool $fullWidth = false;
    public ?string $icon = null;
    public string $label;
    public string $size;
    public bool $spinner = false;
    public string $tag;
    public ?string $target = null;
    public ?string $tooltip = null;
    public string $type;
    public UuidInterface $uuid;
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
        ]);

        $resolver->setAllowedValues('variant', array_keys($this->variants));
        $resolver->setAllowedValues('size', array_keys($this->sizes));
        $resolver->setAllowedValues('iconSize', array_keys($this->iconSizes));
        $resolver->setAllowedValues('type', ['submit', 'reset', 'button']);
        $resolver->setAllowedValues('tag', ['button', 'a']);

        return $resolver->resolve($data) + $data;
    }

    public function mount(): void
    {
        $this->uuid = Uuid::uuid4();
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

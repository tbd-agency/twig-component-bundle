<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent(
    name: 'TBD:Dropdown',
    template: '@TbdTwigComponent/components/TBD/Dropdown.html.twig')]
final class Dropdown
{
    public string $id;
    public ?bool $down;
    public ?string $icon;
    public ?string $label;
    public ?string $variant;
    public ?string $placement;

    public function __construct(
        private readonly array $variants,
    )
    {
    }

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();

        $resolver
            ->setIgnoreUndefined()
            ->setRequired(['id'])
            ->setDefault('down', false)
            ->setDefault('variant', 'primary')
            ->setDefault('placement', 'bottom-end')
            ->setAllowedValues('variant', array_keys($this->variants))
            ->setAllowedValues('placement', ['bottom', 'bottom-end', 'bottom-start', 'right-start', 'left-start']);

        return $resolver->resolve($data) + $data;
    }

    public function getVariantClasses(): ?string
    {
        return $this->variants[$this->variant];
    }
}

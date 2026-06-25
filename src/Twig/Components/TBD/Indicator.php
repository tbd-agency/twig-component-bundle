<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent(
    name: 'TBD:Indicator',
    template: '@TbdTwigComponent/components/TBD/Indicator.html.twig')]
final class Indicator
{
    public string $label;
    public ?string $variant;

    public function __construct(
        private readonly array $variants,
        private readonly string $defaultVariant,
    )
    {
    }

    public function getVariantClasses(): string
    {
        return $this->variants[$this->variant];
    }

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();

        $resolver
            ->setIgnoreUndefined()
            ->setRequired(['label', 'variant'])
            ->setAllowedValues('variant', array_keys($this->variants))
            ->setDefaults([
                'variant' => $this->defaultVariant,
            ]);

        return $resolver->resolve($data) + $data;
    }
}

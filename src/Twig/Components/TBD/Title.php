<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent(
    name: 'TBD:Title',
    template: '@TbdTwigComponent/components/TBD/Title.html.twig')]
final class Title
{
    public string $label;
    public string $fontSize;
    public string $variant;

    public function __construct(
        private readonly array $fontSizes,
        private readonly string $defaultFontSize,
        private readonly array $variants,
        private readonly string $defaultVariant,
    ) {
    }

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();

        $resolver
            ->setIgnoreUndefined()
            ->setRequired('label')
            ->setDefaults(['fontSize' => $this->defaultFontSize, 'variant' => $this->defaultVariant])
            ->setAllowedValues('fontSize', array_keys($this->fontSizes))
            ->setAllowedValues('variant', array_keys($this->variants));

        return $resolver->resolve($data) + $data;
    }

    public function getTextSizeClass(): string
    {
        return $this->fontSizes[$this->fontSize];
    }

    public function getVariantClasses(): string
    {
        return $this->variants[$this->variant];
    }
}

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

    public function __construct(
        private readonly array $fontSizes,
        private readonly string $defaultFontSize,
    ) {
    }

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();

        $resolver
            ->setIgnoreUndefined()
            ->setRequired('label')
            ->setDefaults(['fontSize' => $this->defaultFontSize])
            ->setAllowedValues('fontSize', array_keys($this->fontSizes));

        return $resolver->resolve($data) + $data;
    }

    public function getTextSizeClass(): string
    {
        return $this->fontSizes[$this->fontSize];
    }
}

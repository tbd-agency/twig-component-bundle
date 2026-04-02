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

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();

        $resolver
            ->setIgnoreUndefined()
            ->setRequired('label')
            ->setDefaults(['fontSize' => 'text-4xl'])
            ->setAllowedValues('fontSize', ['text-4xl', 'text-3xl', 'text-2xl', 'text-xl', 'text-lg', 'text-base', 'text-sm']);

        return $resolver->resolve($data) + $data;
    }
}

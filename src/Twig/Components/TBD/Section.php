<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent(
    name: 'TBD:Section',
    template: '@TbdTwigComponent/components/TBD/Section.html.twig')]
final class Section
{

    public bool $wrapper;
    public bool $indented;
    public bool $border;
    public string $padding;

    public function __construct(
        private readonly array $paddings,
    )
    {
    }

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();
        $resolver->setIgnoreUndefined();

        $resolver->setDefaults([
            'padding' => 'large',
            'wrapper' => true,
            'indented' => false,
            'border' => false,
        ]);

        $resolver->setAllowedValues('padding', array_keys($this->paddings));
        $resolver->setAllowedValues('wrapper', [true, false]);
        $resolver->setAllowedValues('indented', [true, false]);
        $resolver->setAllowedValues('border', [true, false]);

        return $resolver->resolve($data) + $data;
    }

    public function getPaddingClasses(): string
    {
        return $this->paddings[$this->padding];
    }
}

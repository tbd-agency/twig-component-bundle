<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent(
    name: 'TBD:Card',
    template: '@TbdTwigComponent/components/TBD/Card.html.twig')]
final class Card
{
    public bool $shadow;
    public string $padding;

    public function __construct(
        private readonly array $paddings,
    )
    {
    }

    public function getPaddingClasses(): string
    {
        return $this->paddings[$this->padding];
    }

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();
        $resolver->setIgnoreUndefined();

        $resolver->setDefaults([
            'padding' => 'default',
            'shadow' => false,
        ]);

        $resolver->setAllowedValues('padding', array_keys($this->paddings));
        $resolver->setAllowedValues('shadow', [true, false]);

        return $resolver->resolve($data) + $data;
    }
}

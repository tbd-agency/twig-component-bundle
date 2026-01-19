<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PostMount;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent(
    name: 'TBD:Badge',
    template: '@TbdTwigComponent/components/TBD/Badge.html.twig')]
final class Badge
{
    public string $label;
    public string $variant;
    public string $size;
    public string $extraClasses = '';

    public function __construct(
        private readonly array $variants,
        private readonly array $sizes,
    )
    {
    }

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();

        $resolver
            ->setIgnoreUndefined()
            ->setDefaults([
                'variant' => 'light-blue',
                'size' => 'md',
            ])
            ->setAllowedValues('variant', array_keys($this->variants))
            ->setAllowedValues('size', array_keys($this->sizes));

        return $resolver->resolve($data) + $data;
    }

    public function getVariantClasses(): string
    {
        return $this->variants[$this->variant];
    }

    public function getSizeClasses(): string
    {
        return $this->sizes[$this->size];
    }

    #[PostMount]
    function postMount(): void
    {
        $this->extraClasses .= ' ' . $this->getSizeClasses();
        $this->extraClasses .= ' ' . $this->getVariantClasses();
    }
}

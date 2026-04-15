<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent(
    name: 'TBD:Spinner',
    template: '@TbdTwigComponent/components/TBD/Spinner.html.twig')]
final class Spinner
{
    public string $size;

    public function __construct(
        private readonly array $sizes,
        private readonly string $defaultSize,
    )
    {
    }

    public function getSizeClass(): string
    {
        return $this->sizes[$this->size];
    }

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();

        $resolver
            ->setIgnoreUndefined()
            ->setDefaults(['size' => $this->defaultSize])
            ->setAllowedValues('size', array_keys($this->sizes));

        return $resolver->resolve($data) + $data;
    }
}

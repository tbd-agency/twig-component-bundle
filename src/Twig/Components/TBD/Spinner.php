<?php

namespace Tbd\TbdComponentBundle\Twig\Components\TBD;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent(
    name: 'TBD:Spinner',
    template: '@TbdComponent/components/TBD/Spinner.html.twig')]
final class Spinner
{
    public string $size;

    public function __construct(private readonly array $sizes)
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
        $resolver->setIgnoreUndefined();

        $resolver->setDefaults(['size' => 'md']);
        $resolver->setAllowedValues('size', array_keys($this->sizes));

        return $resolver->resolve($data) + $data;
    }
}

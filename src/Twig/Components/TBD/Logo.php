<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent(
    name: 'TBD:Logo',
    template: '@TbdTwigComponent/components/TBD/Logo.html.twig')]
final class Logo
{
    public ?string $size;
    public ?string $path;
    public string $image;
    public string $alt;

    public function __construct(
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
            ->setDefaults(['size' => 'md'])
            ->setDefaults(['path' => '#'])
            ->setRequired('image')
            ->setRequired('alt')
            ->setAllowedValues('size', array_keys($this->sizes));

        return $resolver->resolve($data) + $data;
    }

    public function getSizeClasses(): string
    {
        return $this->sizes[$this->size];
    }
}

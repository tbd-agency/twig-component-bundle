<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent(
    name: 'TBD:Avatar',
    template: '@TbdTwigComponent/components/TBD/Avatar.html.twig')]
final class Avatar
{
    public ?string $seed = null;
    public string $size;
    public string $borderRadius;

    public function __construct(
        private readonly array $sizes,
        private readonly array $borderRadii,
    )
    {
    }

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();
        $resolver->setIgnoreUndefined();

        $resolver->setDefaults([
            'borderRadius' => 'full',
            'size' => 'md',
        ]);

        $resolver->setAllowedValues('borderRadius', array_keys($this->borderRadii));
        $resolver->setAllowedValues('size', array_keys($this->sizes));

        return $resolver->resolve($data) + $data;
    }

    public function getSizeClasses(): string
    {
        return $this->sizes[$this->size];
    }

    public function getRoundedClasses(): string
    {
        return $this->borderRadii[$this->borderRadius];
    }
}

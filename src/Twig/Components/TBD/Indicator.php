<?php

namespace Tbd\ComponentBundle\Twig\Components\TBD;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent(
    name: 'TBD:Indicator',
    template: '@TbdComponent/components/TBD/Indicator.html.twig')]
final class Indicator
{
    public string $label;

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();
        $resolver->setIgnoreUndefined();
        $resolver->setRequired('label');

        return $resolver->resolve($data) + $data;
    }
}

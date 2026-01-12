<?php

namespace Tbd\TbdComponentBundle\Twig\Components\TBD;

use Ramsey\Uuid\UuidInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent(
    name: 'TBD:Tooltip',
    template: '@TbdComponent/components/TBD/Tooltip.html.twig')]
final class Tooltip
{
    public UuidInterface $uuid;
    public string $label;

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();
        $resolver->setIgnoreUndefined();

        $resolver->setRequired('uuid');
        $resolver->setRequired('label');

        return $resolver->resolve($data) + $data;
    }

}

<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD;

use Ramsey\Uuid\UuidInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PreMount;
use Twig\Markup;

#[AsTwigComponent(
    name: 'TBD:Tooltip',
    template: '@TbdTwigComponent/components/TBD/Tooltip.html.twig')]
final class Tooltip
{
    public string $identifier;
    public string|Markup $label;

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();

        $resolver
            ->setIgnoreUndefined()
            ->setRequired('identifier')
            ->setRequired('label');

        return $resolver->resolve($data) + $data;
    }

}

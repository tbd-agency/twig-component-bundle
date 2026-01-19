<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD\Dropdown;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent(
    name: 'TBD:Dropdown:Item',
    template: '@TbdTwigComponent/components/TBD/Dropdown/Item.html.twig')]
final class Item
{
    public bool $turbo;
    public string $label;
    public ?string $path;

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();
        $resolver
            ->setIgnoreUndefined()
            ->setRequired('label')
            ->setDefaults(['turbo' => true])
            ->setAllowedValues('turbo', [true, false]);

        return $resolver->resolve($data) + $data;
    }
}

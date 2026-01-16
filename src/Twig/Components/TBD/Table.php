<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent(
    name: 'TBD:Table',
    template: '@TbdTwigComponent/components/TBD/Table.html.twig')]
final class Table
{
    public bool $hasSearch;
    public bool $hasTabs;
    public bool $isSticky;

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();
        $resolver->setIgnoreUndefined();

        $resolver->setDefaults([
            'hasSearch' => false,
            'hasTabs' => false,
            'isSticky' => false,
        ]);

        $resolver->setAllowedValues('hasSearch', [true, false]);
        $resolver->setAllowedValues('hasTabs', [true, false]);
        $resolver->setAllowedValues('isSticky', [true, false]);

        return $resolver->resolve($data) + $data;
    }
}

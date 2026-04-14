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
    public bool $includeWrapper;

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();

        $resolver
            ->setIgnoreUndefined()
            ->setDefaults([
                'hasSearch' => false,
                'hasTabs' => false,
                'isSticky' => false,
                'includeWrapper' => true,
            ])
            ->setAllowedValues('hasSearch', [true, false])
            ->setAllowedValues('hasTabs', [true, false])
            ->setAllowedValues('isSticky', [true, false])
            ->setAllowedValues('includeWrapper', [true, false]);

        return $resolver->resolve($data) + $data;
    }
}

<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent(
    name: 'TBD:ResizableTable',
    template: '@TbdTwigComponent/components/TBD/ResizableTable.html.twig')]
final class ResizableTable
{
    public ?string $path;
    public string $type;
    public ?string $token;
    public bool $hasSearch;
    public bool $hasTabs;
    public string $wrapperClasses;

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();

        $resolver
            ->setIgnoreUndefined()
            ->setRequired('type')
            ->setDefaults([
                'path' => null,
                'token' => null,
                'hasSearch' => false,
                'hasTabs' => false,
                'wrapperClasses' => '',
            ])
            ->setAllowedTypes('path', ['null', 'string'])
            ->setAllowedTypes('type', 'string')
            ->setAllowedTypes('token', ['null', 'string'])
            ->setAllowedValues('hasSearch', [true, false])
            ->setAllowedValues('hasTabs', [true, false])
            ->setAllowedTypes('wrapperClasses', 'string');

        return $resolver->resolve($data) + $data;
    }
}

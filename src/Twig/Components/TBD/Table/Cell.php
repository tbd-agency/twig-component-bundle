<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD\Table;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent(
    name: 'TBD:Table:Cell',
    template: '@TbdTwigComponent/components/TBD/Table/Cell.html.twig')]
final class Cell
{
    public string $tag;
    public ?string $value = null;
    public bool $action;

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();

        $resolver
            ->setIgnoreUndefined()
            ->setDefaults(['tag' => 'th', 'action' => false])
            ->setAllowedValues('tag', ['th', 'td'])
            ->setAllowedTypes('action', 'bool');

        return $resolver->resolve($data) + $data;
    }
}

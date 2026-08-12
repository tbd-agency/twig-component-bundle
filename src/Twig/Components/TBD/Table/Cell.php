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
    public bool $actions;

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();

        $resolver
            ->setIgnoreUndefined()
            ->setDefaults(['tag' => 'th', 'actions' => false])
            ->setAllowedValues('tag', ['th', 'td'])
            ->setAllowedTypes('actions', 'bool');

        return $resolver->resolve($data) + $data;
    }
}

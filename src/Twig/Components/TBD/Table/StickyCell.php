<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD\Table;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent(
    name: 'TBD:Table:StickyCell',
    template: '@TbdTwigComponent/components/TBD/Table/StickyCell.html.twig')]
final class StickyCell
{
    public ?string $value;
    public string $tag;
    public string $position;
    public bool $actions;

    public function __construct(
        private readonly array $positions,
        private readonly string $defaultPosition,
    )
    {
    }

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();
        $resolver
            ->setIgnoreUndefined()
            ->setDefaults([
                'tag' => 'th',
                'position' => $this->defaultPosition,
                'actions' => false,
            ])
            ->setAllowedValues('tag', ['th', 'td'])
            ->setAllowedValues('position', array_keys($this->positions))
            ->setAllowedTypes('actions', 'bool');

        return $resolver->resolve($data) + $data;
    }

    public function getPositionClasses(): string
    {
        return $this->positions[$this->position];
    }
}

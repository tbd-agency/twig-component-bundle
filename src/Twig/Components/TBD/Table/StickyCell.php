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

    public function __construct(private readonly array $positions)
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
                'position' => 'right',
            ])
            ->setAllowedValues('tag', ['th', 'td'])
            ->setAllowedValues('position', array_keys($this->positions));

        return $resolver->resolve($data) + $data;
    }

    public function getPositionClasses(): string
    {
        return $this->positions[$this->position];
    }
}

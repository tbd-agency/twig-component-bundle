<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD\ResizableTable;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent(
    name: 'TBD:ResizableTable:Cell',
    template: '@TbdTwigComponent/components/TBD/ResizableTable/Cell.html.twig')]
final class Cell
{
    public string $column;
    public ?int $width;
    public ?string $value;

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();

        $resolver
            ->setIgnoreUndefined()
            ->setRequired('column')
            ->setDefaults([
                'width' => null,
                'value' => null,
            ])
            ->setAllowedTypes('column', 'string')
            ->setAllowedTypes('width', ['null', 'int', 'string'])
            ->setNormalizer('width', static fn ($options, $width): ?int => empty($width) ? null : (int) $width)
            ->setAllowedTypes('value', ['null', 'string']);

        return $resolver->resolve($data) + $data;
    }

    public function getStyle(): string|false
    {
        if (null === $this->width) {
            return false;
        }

        return sprintf('width: %dpx; min-width: %dpx;', $this->width, $this->width);
    }
}

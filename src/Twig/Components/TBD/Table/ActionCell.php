<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD\Table;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent(
    name: 'TBD:Table:ActionCell',
    template: '@TbdTwigComponent/components/TBD/Table/ActionCell.html.twig')]
final class ActionCell
{
    public string $tag;
    public ?string $value = null;

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();

        $resolver
            ->setIgnoreUndefined()
            ->setDefaults(['tag' => 'th'])
            ->setAllowedValues('tag', ['th', 'td']);

        return $resolver->resolve($data) + $data;
    }
}

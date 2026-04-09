<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD\Dropdown;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent(
    name: 'TBD:Dropdown:Delete',
    template: '@TbdTwigComponent/components/TBD/Dropdown/Delete.html.twig')]
final class Delete
{
    public string $action;
    public int $id;
    public ?string $label = null;

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver()->setIgnoreUndefined();

        $resolver
            ->setRequired(['action', 'id']);

        return $resolver->resolve($data) + $data;
    }
}

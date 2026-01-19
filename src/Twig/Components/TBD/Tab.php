<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent(
    name: 'TBD:Tab',
    template: '@TbdTwigComponent/components/TBD/Tab.html.twig')]
final class Tab
{
    public bool $isActive;
    public string $label;
    public ?string $href = null;
    public ?int $amount = null;

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();

        $resolver
            ->setIgnoreUndefined()
            ->setDefaults(['isActive' => false])
            ->setAllowedValues('isActive', [true, false]);

        return $resolver->resolve($data) + $data;
    }
}

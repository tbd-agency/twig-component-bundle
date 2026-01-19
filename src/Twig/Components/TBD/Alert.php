<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent(
    name: 'TBD:Alert',
    template: '@TbdTwigComponent/components/TBD/Alert.html.twig')]
final class Alert
{
    public ?string $type;

    public function __construct(
        private readonly array $types,
    )
    {
    }

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();

        $resolver
            ->setIgnoreUndefined()
            ->setDefaults(['type' => 'default'])
            ->setAllowedValues('type', array_keys($this->types));

        return $resolver->resolve($data) + $data;
    }

    public function getColorClasses(): string
    {
        return $this->types[$this->type];
    }
}

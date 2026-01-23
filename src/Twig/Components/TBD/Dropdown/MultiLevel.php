<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD\Dropdown;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PostMount;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent(
    name: 'TBD:Dropdown:MultiLevel',
    template: '@TbdTwigComponent/components/TBD/Dropdown/MultiLevel.html.twig')]
final class MultiLevel
{
    public UuidInterface $uuid;
    public string $placement;
    public ?string $icon;
    public ?string $buttonText;
    public ?string $variant;
    public ?bool $down;


    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();
        $resolver
            ->setIgnoreUndefined()
            ->setRequired('buttonText')
            ->setDefaults([
                'variant' => 'multi-level',
                'placement' => 'left-start',
                'down' => true
            ])
            ->setAllowedValues('placement', ['bottom', 'bottom-end', 'bottom-start', 'right-start', 'left-start'])
            ->setAllowedValues('down', [true, false]);

        return $resolver->resolve($data) + $data;
    }

    #[PostMount]
    public function postMount(): void
    {
        $this->uuid = Uuid::uuid4();
    }
}

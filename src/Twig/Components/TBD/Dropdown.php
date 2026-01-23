<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent(
    name: 'TBD:Dropdown',
    template: '@TbdTwigComponent/components/TBD/Dropdown.html.twig')]
final class Dropdown
{
    public UuidInterface $uuid;
    public bool $down;
    public bool $popper;
    public string $buttonVariant;
    public string $buttonSize;
    public ?string $buttonIcon = null;
    public string $buttonText = '';
    public string $buttonTooltip = '';
    public string $buttonBadge = '';
    public string $buttonClasses = '';
    public string $dropdownClasses = '';
    public string $dropdownTrigger;
    public string $dropdownPlacement;

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();

        $resolver
            ->setIgnoreUndefined()
            ->setRequired('id')
            ->setDefaults([
                'id' => 'dropdown',
                'buttonVariant' => 'hollow',
                'buttonSize' => 'md',
                'down' => false,
                'popper' => true,
                'dropdownTrigger' => 'click',
                'dropdownPlacement' => 'bottom-end',
            ])
            ->setAllowedValues('dropdownPlacement', ['bottom', 'bottom-end', 'bottom-start', 'right-start', 'left-start'])
            ->setAllowedValues('down', [true, false])
            ->setAllowedValues('popper', [true, false]);

        return $resolver->resolve($data) + $data;
    }

    public function mount(): void
    {
        $this->uuid = Uuid::uuid4();
    }
}

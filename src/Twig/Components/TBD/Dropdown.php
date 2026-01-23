<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent(
    name: 'TBD:Dropdown',
    template: '@TbdTwigComponent/components/TBD/Dropdown.html.twig')]
final class Dropdown
{
    public string $id;
    public bool $down;
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
                'dropdownTrigger' => 'click',
                'dropdownPlacement' => 'bottom-start',
            ])
            ->setAllowedValues('dropdownPlacement', ['bottom', 'bottom-end', 'bottom-start', 'right-start', 'left-start'])
            ->setAllowedValues('down', [true, false]);

        return $resolver->resolve($data) + $data;
    }

}

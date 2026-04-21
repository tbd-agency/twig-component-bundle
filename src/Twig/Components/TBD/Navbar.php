<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent(
    name: 'TBD:Navbar',
    template: '@TbdTwigComponent/components/TBD/Navbar.html.twig')]
final class Navbar
{
    public string $buttonVariant;
    public string $buttonSize;
    public string $darkModeTooltip;
    public ?string $seed = null;
    public bool $darkMode;
    public ?string $userDropdownContentClasses = null;
    public int $userDropdownOffsetSkidding;
    public int $userDropdownOffsetDistance;

    public function __construct(
        private readonly array $variants,
        private readonly array $sizes,
    )
    {
    }

    public function getVariantClasses(): string
    {
        return $this->variants[$this->buttonVariant];
    }

    public function getSizeClasses(): string
    {
        return $this->sizes[$this->buttonSize];
    }

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();

        $resolver
            ->setIgnoreUndefined()
            ->setDefaults([
                'buttonVariant' => 'white',
                'buttonSize' => 'md',
                'darkMode' => true,
                'darkModeTooltip' => 'Toggle dark mode',
                'userDropdownOffsetSkidding' => 0,
                'userDropdownOffsetDistance' => 10,
            ])
            ->setAllowedValues('buttonVariant', array_keys($this->variants))
            ->setAllowedValues('buttonSize', array_keys($this->sizes))
            ->setAllowedTypes('userDropdownOffsetSkidding', 'int')
            ->setAllowedTypes('userDropdownOffsetDistance', 'int');

        return $resolver->resolve($data) + $data;
    }
}

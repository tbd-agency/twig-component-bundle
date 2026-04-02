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
    public string $buttonVariants;
    public string $buttonSizes;
    public string $darkModeTooltip;
    public ?string $seed = null;
    public bool $darkMode;

    public function __construct(
        private readonly array $variants,
        private readonly array $sizes,
    )
    {
    }

    public function getVariantClasses(): string
    {
        return $this->variants[$this->buttonVariants];
    }
    public function getSizeClasses(): string
    {
        return $this->sizes[$this->buttonSizes];
    }

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();

        $resolver
            ->setIgnoreUndefined()
            ->setDefaults([
                'buttonVariants' => 'white',
                'buttonSizes' => 'md',
                'darkMode' => true,
                'darkModeTooltip' => 'Toggle dark mode',
            ])
            ->setAllowedValues('buttonVariants', array_keys($this->variants))
            ->setAllowedValues('buttonSizes', array_keys($this->sizes));

        return $resolver->resolve($data) + $data;
    }
}

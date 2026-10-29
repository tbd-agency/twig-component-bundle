<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent(
    name: 'TBD:Select',
    template: '@TbdTwigComponent/components/TBD/Select.html.twig')]
final class Select
{
    public ?int $total;
    public ?string $buttonVariant;
    public ?string $buttonSize;
    public ?string $dropdownPlacement;
    public ?string $labelSelected;
    public ?string $labelItemsSelected;
    public ?string $labelSelectAll;
    public ?string $labelRemoveSelection;

    public function __construct(private readonly array $variants, private readonly string $defaultButtonSize)
    {
    }

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();

        $resolver
            ->setIgnoreUndefined()
            ->setDefaults([
                'buttonVariant' => 'primary',
                'buttonSize' => $this->defaultButtonSize,
                'dropdownPlacement' => 'bottom-start',
            ])
            ->setAllowedValues('dropdownPlacement', ['bottom', 'bottom-start', 'bottom-end', 'right-start', 'left-start'])
            ->setAllowedValues('buttonVariant', array_keys($this->variants));

        return $resolver->resolve($data) + $data;
    }
}

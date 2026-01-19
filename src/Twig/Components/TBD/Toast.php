<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent(
    name: 'TBD:Toast',
    template: '@TbdTwigComponent/components/TBD/Toast.html.twig')]
final class Toast
{
    public string $type;
    public ?string $message = null;
    public bool $autoClose;
    public int $timeUntilClose = 10000;
    public string $iconSize;

    public function __construct(
        private readonly array $iconSizes,
    )
    {
    }

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();
        $resolver->setIgnoreUndefined();

        $resolver->setDefaults([
            'type' => 'success',
            'iconSize' => 'md',
            'autoClose' => true,
        ]);

        $resolver->setAllowedValues('type', ['success', 'error']);
        $resolver->setAllowedValues('iconSize', array_keys($this->iconSizes));
        $resolver->setAllowedValues('autoClose', [true, false]);

        return $resolver->resolve($data) + $data;
    }

    public function getIconSizeClasses(): string
    {
        return $this->iconSizes[$this->iconSize];
    }

    public function getIcon(): string
    {
        return match ($this->type) {
            'error' => 'circle-xmark',
            default => 'circle-check'
        };
    }

    public function getColorClasses(): string
    {
        return match ($this->type) {
            'error' => '!border-red-400 !bg-red-50 text-red-600',
            default => '!border-green-500 !bg-green-50 text-green-700',
        };
    }
}

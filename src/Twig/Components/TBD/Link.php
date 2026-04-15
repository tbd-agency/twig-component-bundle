<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD;

use InvalidArgumentException;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent(
    name: 'TBD:Link',
    template: '@TbdTwigComponent/components/TBD/Link.html.twig')]
final class Link
{
    public ?string $label = null;
    public string $href = '#';
    public ?string $prependIcon = null;
    public ?string $appendIcon = null;
    public string $iconSize;

    public function __construct(
        private readonly array $iconSizes,
        private readonly array $prependIconMargins,
        private readonly array $appendIconMargins,
        private readonly string $defaultIconSize,
    )
    {
    }

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();
        $resolver->setIgnoreUndefined();

        $resolver->setDefaults([
            'iconSize' => $this->defaultIconSize,
        ]);

        $iconSize = $data['iconSize'] ?? $this->defaultIconSize;

        $missingIn = [];

        if (!array_key_exists($iconSize, $this->iconSizes)) {
            $missingIn[] = 'icon_sizes';
        }
        if (!array_key_exists($iconSize, $this->prependIconMargins)) {
            $missingIn[] = 'prepend_icon_margins';
        }
        if (!array_key_exists($iconSize, $this->appendIconMargins)) {
            $missingIn[] = 'append_icon_margins';
        }

        if ($missingIn !== []) {
            throw new InvalidArgumentException(sprintf(
                'Invalid iconSize "%s". Missing in: %s.',
                $iconSize,
                implode(', ', $missingIn)
            ));
        }

        return $resolver->resolve($data) + $data;
    }

    public function getIconSizeClasses(): string
    {
        return $this->iconSizes[$this->iconSize];
    }

    public function getMarginClasses(): string
    {
        $classes = [];

        if ($this->prependIcon) {
            $classes[] = $this->prependIconMargins[$this->iconSize];
        }
        if ($this->appendIcon) {
            $classes[] = $this->appendIconMargins[$this->iconSize];
        }

        return implode(' ', array_filter($classes));
    }
}

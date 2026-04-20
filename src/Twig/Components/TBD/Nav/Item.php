<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD\Nav;

use Ramsey\Uuid\Uuid;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent(
    name: 'TBD:Nav:Item',
    template: '@TbdTwigComponent/components/TBD/Nav/Item.html.twig')]
final class Item
{
    public string $tag;
    public string $label;
    public mixed $badge = null;
    public ?string $path = null;
    public ?string $icon = null;
    public ?string $badgeType = null;
    public string $identifier;
    public ?string $tooltip = null;
    public ?string $tooltipPlacement = null;

    public function __construct(
        private readonly array  $badgeTypes,
        private readonly string $defaultBadgeType,
    )
    {
    }

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver()->setIgnoreUndefined();

        $resolver
            ->setDefaults(['tag' => 'a'])
            ->setAllowedValues('tag', ['a', 'span', 'div']);

        if (!empty($data['tag']) && $data['tag'] === 'a') {
            $resolver->setRequired('path');
        }

        if (!empty($data['badge'])) {
            $resolver
                ->setDefaults(['badgeType' => $this->defaultBadgeType])
                ->setRequired('badgeType')
                ->setAllowedValues('badgeType', array_keys($this->badgeTypes));
        }

        if (!empty($data['tooltip'])) {
            $resolver
                ->setRequired('tooltipPlacement')
                ->setDefault('tooltipPlacement', 'right')
                ->setAllowedValues('tooltipPlacement', ['top', 'bottom', 'left', 'right']);
        }

        return $resolver->resolve($data) + $data;
    }

    public function mount(): void
    {
        $this->identifier = Uuid::uuid4()->toString();
    }

    public function getBadgeClasses(): string
    {
        return $this->badgeTypes[$this->badgeType];
    }
}

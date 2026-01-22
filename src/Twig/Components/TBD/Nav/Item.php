<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD\Nav;

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

    public function __construct(
        private readonly array $badgeTypes,
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

        if ($data['tag'] === 'a') {
            $resolver->setRequired('path');
        }

        if (!empty($data['badge'])) {
            $resolver
                ->setDefaults([
                    'badgeType' => 'errors',
                ])
                ->setRequired('badgeType')
                ->setAllowedValues('badgeType', array_keys($this->badgeTypes));
        }

        return $resolver->resolve($data) + $data;
    }

    public function getBadgeClasses(): string
    {
        return $this->badgeTypes[$this->badgeType];
    }
}

<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD\Nav;

use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PostMount;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent(
    name: 'TBD:Nav:Dropdown',
    template: '@TbdTwigComponent/components/TBD/Nav/Dropdown.html.twig')]
final class Dropdown
{
    public bool $isHidden;
    public mixed $badge;
    public string $label;
    public ?string $id = null;
    public ?array $paths = [];
    public ?string $icon = null;
    public ?string $badgeType = null;
    public string $identifier;
    public ?string $tooltip = null;
    public ?string $tooltipPlacement = null;

    public function __construct(
        public readonly RequestStack $requestStack,
        public readonly array        $badgeTypes,
        private readonly string      $defaultBadgeType,
    )
    {
    }

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver()->setIgnoreUndefined();

        if (empty($data['id'])) {
            $resolver->setDefault('id', Uuid::uuid4()->toString());
        }

        $resolver
            ->setRequired('label')
            ->setDefaults([
                'isHidden' => true,
                'badgeType' => $this->defaultBadgeType,
            ])
            ->setAllowedValues('isHidden', [true, false]);

        if (!empty($data['badge'])) {
            $resolver
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

    #[PostMount]
    public function postMount(): void
    {
        $request = $this->requestStack->getCurrentRequest();
        foreach ($this->paths as $path) {
            if ($path === $request->getPathInfo()) {
                $this->isHidden = false;
                break;
            }
        }
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

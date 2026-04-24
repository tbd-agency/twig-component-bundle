<?php

namespace Tbd\TwigComponentBundle\Twig\Extension;

use Symfony\Component\HttpFoundation\RequestStack;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    public function __construct(private readonly RequestStack $requestStack)
    {
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter('IsBool', [$this, 'isBool']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('IsBool', [$this, 'isBool']),
            new TwigFunction('sidebarExpanded', [$this, 'isSidebarExpanded']),
            new TwigFunction('sidebarHoverState', [$this, 'isSidebarHoverState']),
        ];
    }

    public function isBool($value): bool
    {
        return $this->IsBool($value);
    }

    public function isSidebarExpanded(): bool
    {
        $cookie = $this->requestStack->getCurrentRequest()?->cookies->get('sidebar');

        return $cookie !== 'false';
    }

    public function isSidebarHoverState(): bool
    {
        $cookie = $this->requestStack->getCurrentRequest()?->cookies->get('sidebar-hover-state');

        return $cookie !== 'false';
    }
}

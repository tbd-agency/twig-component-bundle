<?php

namespace Tbd\TwigComponentBundle\Twig\Extension;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('strip_scripts', [$this, 'stripScripts'], ['is_safe' => ['html']]),
            new TwigFilter('is_bool', [$this, 'isBool']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('is_bool', [$this, 'isBool']),
        ];
    }

    public function stripScripts($html): array|string|null
    {
        return preg_replace('#<script(.*?)>(.*?)</script>#is', '', $html);
    }

    public function isBool($value): bool
    {
        return is_bool($value);
    }
}

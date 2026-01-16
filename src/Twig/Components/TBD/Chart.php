<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent(
    name: 'TBD:Chart',
    template: '@TbdTwigComponent/components/TBD/Chart.html.twig')]
final class Chart
{
    public string $class;
    public string $route;
    public string $type;
    public string $label;
    public array $headerWidths;
    public array $horizontalHeaders;
    public array $verticalHeaders;
    public int $horizontalHeaderWidth;
    public int $verticalHeaderWidth;

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = (new OptionsResolver())
            ->setIgnoreUndefined()
            ->setRequired(['type', 'route'])
            ->setAllowedValues('type', ['number', 'doughnut', 'bar', 'table'])
            ->setAllowedTypes('type', 'string')
            ->setAllowedTypes('route', 'string');

        if ($data['type'] === 'table') {
            $resolver
                ->setDefined(['horizontalHeaders', 'verticalHeaders', 'horizontalHeaderWidth', 'verticalHeaderWidth'])
                ->setAllowedTypes('horizontalHeaders', 'array')
                ->setAllowedTypes('verticalHeaders', 'array');

            if (!empty($data['horizontalHeaders'])) {
                $resolver
                    ->setRequired('horizontalHeaderWidth')
                    ->setAllowedTypes('horizontalHeaderWidth', 'int');
            }

            if (!empty($data['verticalHeaders'])) {
                $resolver
                    ->setRequired('verticalHeaderWidth')
                    ->setAllowedTypes('verticalHeaderWidth', 'int');
            }

            $widths = [];
            if (!empty($data['horizontalHeaders'])) {
                for ($i = 0; $i < count($data['horizontalHeaders']); $i++) {
                    if ($i == 0 && $data['verticalHeaderWidth']) {
                        $widths[$i] = $data['verticalHeaderWidth'];
                        continue;
                    }

                    $widths[$i] = $data['horizontalHeaderWidth'];
                }
            }

            $data['headerWidths'] = $widths;
        }

        return $resolver->resolve($data) + $data;
    }
}

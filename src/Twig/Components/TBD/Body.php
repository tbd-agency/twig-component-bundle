<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;

#[AsTwigComponent(
    name: 'TBD:Body',
    template: '@TbdTwigComponent/components/TBD/Body.html.twig')]
final class Body
{
    public bool $delete = true;
    public bool $sidebar = true;
    public bool $modal = true;
    public bool $url = true;
    public bool $sidebarHoverState = false;

    #[ExposeInTemplate]
    public function getControllers(): string
    {
        $controllers = ['app'];
        if ($this->delete) {
            $controllers[] = 'delete';
        }
        if ($this->sidebar) {
            $controllers[] = 'sidebar';
        }
        if ($this->modal) {
            $controllers[] = 'modal';
        }
        if ($this->url) {
            $controllers[] = 'url';
        }

        return implode(' ', $controllers);
    }
}

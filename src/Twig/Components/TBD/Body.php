<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;

#[AsTwigComponent(
    name: 'TBD:Body',
    template: '@TbdTwigComponent/components/TBD/Body.html.twig')]
final class Body
{
    public bool $sidebar = true;
    public bool $modal = true;
    public bool $url = true;
    public bool $theme = true;
    public bool $sidebarHoverState = false;

    #[ExposeInTemplate]
    public function getControllers(): string
    {
        $controllers = ['app'];
        if ($this->sidebar) {
            $controllers[] = 'sidebar';
        }
        if ($this->modal) {
            $controllers[] = 'modal';
        }
        if ($this->url) {
            $controllers[] = 'url';
        }
        if ($this->theme) {
            $controllers[] = 'theme';
        }

        return implode(' ', $controllers);
    }
}

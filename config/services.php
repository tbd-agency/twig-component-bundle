<?php

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Tbd\TbdComponentBundle\Twig\Components\TBD\Button;
use Tbd\TbdComponentBundle\Twig\Components\TBD\Spinner;

return static function (ContainerConfigurator $configurator): void {
    $services = $configurator->services()
        ->defaults()
        ->autowire()
        ->autoconfigure();

    $services
        ->load('Tbd\\TbdComponentBundle\\', __DIR__ . '/../src/')
        ->exclude([
            __DIR__ . '/../src/TbdComponentBundle.php',
        ]);

    # Write variables to the component constructor
    $services
        ->set(Button::class)
        ->args([
            '$variants' => '%button.variants%',
            '$sizes' => '%button.sizes%',
            '$iconSizes' => '%icon.sizes%',
        ]);

    $services
        ->set(Spinner::class)
        ->args([
            '$sizes' => '%icon.sizes%',
        ]);
};

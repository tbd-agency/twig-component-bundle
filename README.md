tbd/tbd-component-bundle
This bundle provides a simple way to implement wide used components.

## Installation

### Install the bundle via Composer:

```bash
composer require tbd/tbd-component-bundle
```

### Enable the bundle in your `config/bundles.php` file:

> [!NOTE]
> This step is not required if you are using Symfony Flex.

```php
return [
    // ...
   Tbd\TbdComponentBundle\TbdComponentBundle::class => ['all' => true],
];
```

### Allow bootstrap to read symfony controllers in the bundle :

### bootstrap.js

```
// Also load controllers from the tbd-component-bundle (inside vendor/)
const tbdControllers = require.context(
    '@symfony/stimulus-bridge/lazy-controller-loader!../vendor/tbd/tbd-component-bundle/assets/controllers',
    true,
    /_controller\.[jt]sx?$/
);

for (const key of tbdControllers.keys()) {
    const mod = tbdControllers(key);

    const name = key
        .replace(/^\.\//, '')
        .replace(/\.[jt]sx?$/, '')
        .replace(/_controller$/, '')
        .replace(/\//g, '--')
        .replace(/_/g, '-');

    app.register(name, mod.default);
}
```

### Allow symfony to read the components in the bundle :

### twig_component.yaml

```yaml
    # Also recognize twig components from TbdComponentBundle
    Tbd\TbdComponentBundle\Twig\Component\:
      template_directory: '@TbdTwigComponent/components'
```

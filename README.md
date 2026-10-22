# tbd/twig-component-bundle

A Symfony bundle containing a shared library of reusable Twig components.

The Stimulus controllers used by these components are provided by a separate
package, [`tbd/stimulus-bundle`](https://github.com/tbd-agency/stimulus-bundle),
which is installed automatically as a dependency.

## Requirements

- PHP 8.4 or higher
- Symfony 7 or 8, with Symfony Flex
- Tailwind CSS v4 (projects on Tailwind CSS v3 stay on 1.x of this bundle)
- Flowbite and Hotwire Turbo
- Webpack Encore or AssetMapper, for the Stimulus controllers

## Quick start

1. Add the TBD Flex recipes endpoint and the two VCS repositories to your
   `composer.json`, see [Configure Composer](docs/installation.md#1-configure-composer).
2. Install the bundle and its npm package:

   ```bash
   composer require tbd/twig-component-bundle
   npm install
   ```

3. Enable the Stimulus controllers you use in `assets/controllers.json`,
   see [Stimulus controllers](docs/installation.md#32-stimulus-controllers).
4. Check `assets/styles/app.css` and add Flowbite, see
   [Tailwind CSS, Flowbite and Turbo](docs/installation.md#34-tailwind-css-flowbite-and-turbo).

## Documentation

| Page | What it covers |
|---|---|
| [Installation](docs/installation.md) | Composer setup, what Flex sets up, Stimulus controllers, icons and routes, Tailwind CSS, Flowbite and Turbo |
| [Colour tokens](docs/colours.md) | The `tbd-*` colours, light and dark mode, all values, using your own colours |
| [Customising the components](docs/customising.md) | Overriding template blocks, variants, types and sizes |
| [Upgrading from 1.x](docs/upgrading.md) | Steps from 1.x to 2.0, including the Twig cache |

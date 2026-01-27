tbd/twig-component-bundle
A Symfony bundle containing a shared library of reusable Twig components.

## Installation

This bundle is distributed as a **private Composer package** and uses **private Symfony Flex recipes**.
Follow the steps below to install it correctly in your project.

---

### 1. Configure Composer (required)

#### 1.1 Enable the private Flex recipes repository

Add the following configuration to your project’s `composer.json`:

```json
{
  "extra": {
    "symfony": {
      "endpoint": [
        "https://api.github.com/repos/tbd-agency/recipes/contents/index.json",
        "flex://defaults"
      ],
      "allow-contrib": true,
      "require": "7.4.*"
    }
  }
}
```

This allows Symfony Flex to discover and apply our **internal recipes** automatically.

---

#### 1.2 Register the private VCS repository

Because this is a private GitHub repository, you must also add it under `repositories` in `composer.json`:

```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "git@github.com:tbd-agency/twig-component-bundle.git"
    }
  ]
}
```

---

### 2. Install the bundle

Run the following command:

```bash
composer require tbd/twig-component-bundle
```

---

## Post-installation requirements

For this bundle to work correctly, **three things must be in place** after installation.

When Symfony Flex is configured properly, the recipe will normally handle the first two steps automatically.  
The third step must always be done manually.

### 1. Twig Component configuration (handled by Flex recipe)

The Flex recipe should create the following configuration file automatically:

`tbd_twig_component.yaml`

```yaml
tbd_twig_component:
  twig_component:
    defaults:
      Tbd\TwigComponentBundle\Twig\Components\TBD\: 'components/tbd/'
```

This registers the bundle’s Twig components under the `components/tbd/` namespace.

---

### 2. Stimulus controller registration (handled by Flex recipe)

The Flex recipe should also update your `bootstrap.js` file to register the Stimulus controllers provided by this bundle.

Make sure the following code is present in `bootstrap.js`:

```js
// tbd/twig-component-bundle: register controllers (inside vendor/)
const tbdControllers = require.context(
    '@symfony/stimulus-bridge/lazy-controller-loader!../vendor/tbd/twig-component-bundle/assets/controllers',
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

This makes the bundle’s Stimulus controllers available to your application.

---

### 3. Tailwind CSS, Flowbite & Hotwire Turbo configuration (manual step)

This bundle is built to work with **Tailwind CSS** for styling, **Flowbite** for prebuilt UI components, and **Hotwire Turbo (Turbo Frames)** for frontend interactions.
All dependencies must be installed and configured correctly for the components to render and behave as expected.

Make sure the following frontend dependencies are available in your application:
- **Tailwind CSS**
- **Hotwire Turbo**
- **Flowbite**

If Tailwind CSS is not installed yet, install and initialize it first by following the official Tailwind CSS documentation.

Symfony Flex recipes cannot safely modify frontend build configuration files, which means the following steps must always be done manually.

---
##### Tailwind v3 configuration (`tailwind.config.js`)

When using Tailwind CSS v3, ensure the bundle paths are included in the `content` array of your `tailwind.config.js` file:

```js
content: [
    './vendor/tbd/twig-component-bundle/templates/**/*.html.twig',
    './vendor/tbd/twig-component-bundle/src/**/*.php',
]
```
##### Tailwind v4 configuration (`app.css`)

When using Tailwind CSS v4, no tailwind.config.js file is required.

Instead, add the bundle paths as sources in your main CSS entry file (for example assets/styles/app.css):
```css
@source '../../vendor/tbd/twig-component-bundle/templates/**/*.html.twig';
@source '../../vendor/tbd/twig-component-bundle/src/**/*.php';
```

This ensures Tailwind can detect and generate styles for the bundled Twig components.




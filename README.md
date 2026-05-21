# tbd/twig-component-bundle

A Symfony bundle containing a shared library of reusable Twig components.

The Stimulus controllers used by these components are provided by a separate
package, [`tbd/stimulus-bundle`](https://github.com/tbd-agency/stimulus-bundle),
which is installed automatically as a dependency.

## Installation

This bundle is distributed as a **private Composer package** and uses
**private Symfony Flex recipes**. Follow the steps below to install it
correctly in your project.

---

### 1. Configure Composer (required)

#### 1.1 Enable the private Flex recipes repository

Add the following configuration to your project's `composer.json`:

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

This allows Symfony Flex to discover and apply our **internal recipes**
automatically.

---

#### 1.2 Register the private VCS repositories

Because both this bundle and its Stimulus dependency are hosted in private
GitHub repositories, you must register them under `repositories` in your
project's `composer.json`:

```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "git@github.com:tbd-agency/twig-component-bundle.git"
    },
    {
      "type": "vcs",
      "url": "git@github.com:tbd-agency/stimulus-bundle.git"
    }
  ]
}
```

Both entries are required: Composer needs to resolve `tbd/stimulus-bundle`
directly from its own VCS repository when it is pulled in as a dependency
of `tbd/twig-component-bundle`.

---

### 2. Install the bundle

Run the following command:

```bash
composer require tbd/twig-component-bundle
```

This will also pull in `tbd/stimulus-bundle` automatically.

---

## Post-installation requirements

For this bundle to work correctly, **three things must be in place** after
installation.

When Symfony Flex is configured properly, the recipe will normally handle
the first two steps automatically. The third step must always be done
manually.

### 1. Twig Component configuration (handled by Flex recipe)

The Flex recipe should create the following configuration file automatically:

`config/packages/tbd_twig_component.yaml`

```yaml
tbd_twig_component:
  twig_component:
    defaults:
      Tbd\TwigComponentBundle\Twig\Components\TBD\: 'components/tbd/'
```

This registers the bundle's Twig components under the `components/tbd/`
namespace.

---

### 2. Stimulus controller registration (Flex recipe + `npm install`)

The Stimulus controllers used by the components live in the separate
`tbd/stimulus-bundle` package. They are exposed to the Symfony UX
Stimulus bridge under the `@tbd/stimulus-bundle` namespace via your
application's `assets/controllers.json`.

After `composer require`, the Flex recipe does two things automatically:

1. It adds the `@tbd/stimulus-bundle` block (shown below) to
   `assets/controllers.json`.
2. It registers the npm package as a local dependency in your
   `package.json`:

   ```json
   {
     "dependencies": {
       "@tbd/stimulus-bundle": "file:vendor/tbd/stimulus-bundle/assets"
     }
   }
   ```

This is **not enough on its own** — the controllers will not load until
the npm package is actually installed. After `composer require`, always
run:

```bash
npm install
```

Only after `npm install` resolves the `file:vendor/tbd/stimulus-bundle/assets`
dependency will the controllers below actually become available in your
application:

| Controller       | Fetch  | Enabled | Autoimports CSS |
|------------------|--------|---------|------------------|
| `ajax-submit`    | lazy   | yes     |                  |
| `app`            | eager  | yes     |                  |
| `chart`          | lazy   | yes     |                  |
| `closeable`      | lazy   | yes     | `closeable.css`  |
| `confirm`        | lazy   | yes     |                  |
| `dashboard`      | lazy   | yes     |                  |
| `dropdown`       | lazy   | yes     |                  |
| `flatpickr`      | lazy   | yes     | `flatpickr.css`  |
| `inline-edit`    | lazy   | yes     |                  |
| `marker`         | lazy   | yes     |                  |
| `modal`          | lazy   | yes     |                  |
| `reset-search`   | lazy   | yes     |                  |
| `select-items`   | lazy   | yes     |                  |
| `sidebar`        | lazy   | yes     |                  |
| `sortable`       | eager  | yes     |                  |
| `theme`          | eager  | yes     |                  |
| `url`            | lazy   | yes     | `url.css`        |

Notes:

- Controllers marked `"enabled": false` (e.g. `marker`) are opt-in — flip
  them to `true` only if your application actually uses them.
- The `autoimport` entries pull in the CSS that ships with the matching
  controller. Keep them enabled unless you provide your own styles.
- After editing `controllers.json`, rebuild your assets (for example with
  `php bin/console asset-map:compile` or your usual asset pipeline) so the
  new controllers are picked up.

---

### 3. Tailwind CSS, Flowbite & Hotwire Turbo configuration (manual step)

This bundle is built to work with **Tailwind CSS** for styling, **Flowbite**
for prebuilt UI components, and **Hotwire Turbo (Turbo Frames)** for
frontend interactions. All dependencies must be installed and configured
correctly for the components to render and behave as expected.

Make sure the following frontend dependencies are available in your
application:

- **Tailwind CSS**
- **Hotwire Turbo**
- **Flowbite**

If Tailwind CSS is not installed yet, install and initialize it first by
following the official Tailwind CSS documentation.

Symfony Flex recipes cannot safely modify frontend build configuration
files, which means the following steps must always be done manually.

---

#### Tailwind v3 configuration (`tailwind.config.js`)

When using Tailwind CSS v3, ensure both bundles' template and source paths
are included in the `content` array of your `tailwind.config.js` file:

```js
content: [
    './vendor/tbd/twig-component-bundle/templates/**/*.html.twig',
    './vendor/tbd/twig-component-bundle/src/**/*.php',
    './vendor/tbd/stimulus-bundle/assets/src/**/*.js',
]
```

#### Tailwind v4 configuration (`app.css`)

When using Tailwind CSS v4, no `tailwind.config.js` file is required.

Instead, add the bundle paths as sources in your main CSS entry file (for
example `assets/styles/app.css`):

```css
@source '../../vendor/tbd/twig-component-bundle/templates/**/*.html.twig';
@source '../../vendor/tbd/twig-component-bundle/src/**/*.php';
@source '../../vendor/tbd/stimulus-bundle/assets/src/**/*.js';
```

This ensures Tailwind can detect and generate styles for the markup
rendered by the bundled Twig components and their Stimulus controllers.


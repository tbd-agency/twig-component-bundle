# Installation

[← Back to the README](../README.md)

**Requirements**

- PHP 8.4 or higher
- Symfony 7 or 8, with Symfony Flex
- Tailwind CSS v4 (projects on Tailwind CSS v3 stay on 1.x of this bundle)
- Flowbite and Hotwire Turbo
- Webpack Encore or AssetMapper, for the Stimulus controllers

**On this page**

- [1. Configure Composer](#1-configure-composer)
  - [1.1 Add the TBD Flex recipes endpoint](#11-add-the-tbd-flex-recipes-endpoint)
  - [1.2 Add the VCS repositories](#12-add-the-vcs-repositories)
- [2. Install the bundle](#2-install-the-bundle)
- [3. After installation](#3-after-installation)
  - [3.1 Component configuration](#31-component-configuration)
  - [3.2 Stimulus controllers](#32-stimulus-controllers)
  - [3.3 Icons and routes](#33-icons-and-routes)
  - [3.4 Tailwind CSS, Flowbite and Turbo](#34-tailwind-css-flowbite-and-turbo)

---

This bundle and its Stimulus controllers are not published on Packagist,
and the Flex recipe lives in TBD's own recipes repository,
[`tbd-agency/recipes`](https://github.com/tbd-agency/recipes). Configure
Composer for both before you install the bundle.

---

## 1. Configure Composer

### 1.1 Add the TBD Flex recipes endpoint

Add the endpoint to `extra.symfony` in your project's `composer.json`,
before `flex://defaults`:

```json
{
  "extra": {
    "symfony": {
      "endpoint": [
        "https://api.github.com/repos/tbd-agency/recipes/contents/index.json",
        "flex://defaults"
      ],
      "allow-contrib": true
    }
  }
}
```

- The TBD recipes are marked as contrib recipes. With
  `"allow-contrib": false`, Flex asks for confirmation before it applies
  them, and skips them in a non-interactive run (for example in CI).
- Keep the other keys under `extra.symfony`, such as `require`, as they
  are: they belong to your project.

### 1.2 Add the VCS repositories

Register both packages under `repositories` in your project's
`composer.json`:

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

Both entries are required: `tbd/stimulus-bundle` is a dependency of this
bundle, and Composer only finds it through its own repository entry.

---

## 2. Install the bundle

```bash
composer require tbd/twig-component-bundle
```

This installs the latest 2.x release and `tbd/stimulus-bundle` with it. On
a Tailwind CSS v3 project, require `tbd/twig-component-bundle:^1.0`
instead.

---

## 3. After installation

Flex sets up most of the bundle. What it does, and what is left to you:

| What | Done by | Result |
|---|---|---|
| Register the bundle | Recipe | `config/bundles.php` |
| Component configuration | Recipe | `config/packages/tbd_twig_component.yaml` |
| Colour tokens and Tailwind sources | Recipe | Four lines in `assets/styles/app.css` |
| npm package | Flex (Symfony UX) | `@tbd/stimulus-bundle` under `devDependencies` in `package.json` |
| Stimulus controllers | Flex (Symfony UX) | All controllers in `assets/controllers.json`, **disabled** |
| `npm install` and enabling controllers | You | See [3.2](#32-stimulus-controllers) |
| Tailwind CSS, Flowbite, Turbo and icons | You | See [3.3](#33-icons-and-routes) and [3.4](#34-tailwind-css-flowbite-and-turbo) |

### 3.1 Component configuration

The recipe creates `config/packages/tbd_twig_component.yaml`:

```yaml
tbd_twig_component:

twig_component:
  defaults:
    Tbd\TwigComponentBundle\Twig\Components\TBD\: 'components/tbd/'
```

The `twig_component` entry registers the bundle's components with Symfony
UX Twig Component. Under `tbd_twig_component` you can configure the
components, see [Customising the components](customising.md).

---

### 3.2 Stimulus controllers

The Stimulus controllers live in `tbd/stimulus-bundle`, a Symfony UX
package. Flex adds it to `package.json` and adds its controllers to
`assets/controllers.json`, under `@tbd/stimulus-bundle`. Install the npm
package:

```bash
npm install
```

Flex adds every controller with `"enabled": false`. Enable the controllers
of the components you use, by setting `"enabled": true` in
`assets/controllers.json`:

| Controller | Used by | Fetch | Loads CSS |
|---|---|---|---|
| `app` | `TBD:Body`, `TBD:Dropdown:Delete` | eager | |
| `chart` | Chart partial loaded by `TBD:Chart` | lazy | |
| `closeable` | `TBD:Toast` | lazy | `closeable.css` |
| `dashboard` | `TBD:Chart` | lazy | |
| `dropdown` | `TBD:Dropdown`, `TBD:Select`, user menu of `TBD:Navbar` | lazy | |
| `modal` | `TBD:Body`, `TBD:Modal:*`, `TBD:Dropdown:Delete` | lazy | |
| `reset-search` | `TBD:Form:Search` | lazy | |
| `resizable-table` | `TBD:ResizableTable` | eager | |
| `select-items` | `TBD:Select` | lazy | `select-items.css` |
| `sidebar` | `TBD:Body`, `TBD:Sidebar`, `TBD:Navbar`, `TBD:Nav:Dropdown` | lazy | |
| `theme` | `TBD:Body`, dark mode toggle of `TBD:Navbar` | eager | `theme.css` |
| `tooltip` | `tooltip` prop of `TBD:Button`, `TBD:Nav:Item`, `TBD:Nav:Dropdown` and `TBD:SubTitle` | lazy | |
| `url` | `TBD:Body`, clickable `TBD:Table:Row` | lazy | `url.css` |

The other controllers are not used by the components: `ajax-submit`,
`confirm`, `flatpickr` (loads `flatpickr.css`), `inline-edit`, `marker` and
`sortable`. Enable them only when your own templates use them.

The `app`, `sidebar`, `modal`, `url` and `theme` controllers belong on
`<body>`. `TBD:Body` renders them; set its `sidebar`, `modal`, `url` or
`theme` prop to `false` to leave one out. `TBD:Html` sets the `dark` class
from the theme cookie:

```twig
<twig:TBD:Html>
    <head>…</head>
    <twig:TBD:Body>
        …
    </twig:TBD:Body>
</twig:TBD:Html>
```

Rebuild your assets after changing `controllers.json`, for example with
`npm run dev` (Webpack Encore) or `php bin/console asset-map:compile`
(AssetMapper).

---

### 3.3 Icons and routes

Two components need something from your project:

- `TBD:Navbar` uses four icons from your own icon set: `bars`,
  `bars-staggered`, and `moon` and `sun-bright` for the dark mode toggle.
  Add them as SVG files in `assets/icons/` (Symfony UX Icons). The bundle's
  own icons use the `tbd:` prefix and need nothing.
- `TBD:ResizableTable` saves column widths through the route `table_resize`.
  Define that route in your project, or pass a `path` to the component.

---

### 3.4 Tailwind CSS, Flowbite and Turbo

Install Tailwind CSS v4, Flowbite and Hotwire Turbo if the project does not
have them yet, following their own documentation. Version 2.x of this
bundle requires Tailwind CSS v4: its colours come from
`assets/styles/theme.css`, which uses `@theme`. See [Colour tokens](colours.md).

The recipe adds the four bundle lines below to `assets/styles/app.css`,
right after the line that imports Tailwind. Add the Flowbite lines
yourself:

```css
@import 'tailwindcss';
@import '../../vendor/tbd/twig-component-bundle/assets/styles/theme.css';
@source '../../vendor/tbd/twig-component-bundle/templates/**/*.html.twig';
@source '../../vendor/tbd/twig-component-bundle/src/**/*.php';
@source '../../vendor/tbd/stimulus-bundle/assets/src/**/*.js';

@plugin 'flowbite/plugin';
@source '../../node_modules/flowbite';
```

- **The `@source` lines are required.** Tailwind v4 skips `vendor/`, so
  without them the component classes are missing from the build. The
  default variants (button, badge, alert, toast, …) are defined in
  `src/**/*.php`.
- **Existing lines are skipped.** If your CSS entry lives elsewhere, or the
  recipe cannot find the Tailwind import, it prints the lines so you can
  add them yourself. When upgrading from 1.x, the recipe update adds them,
  see [Upgrading from 1.x](upgrading.md).
- **Load Flowbite's JavaScript.** On small screens `TBD:Navbar` opens the
  sidebar with Flowbite's drawer. With Turbo, import it in `assets/app.js`:

  ```js
  import 'flowbite/dist/flowbite.turbo.js';
  ```

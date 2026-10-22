# Colour tokens

[← Back to the README](../README.md)

**On this page**

- [Colours, not extra classes](#colours-not-extra-classes)
- [Light and dark mode without `dark:`](#light-and-dark-mode-without-dark)
- [Using the colours in your own templates](#using-the-colours-in-your-own-templates)
- [Role colours (switch between light and dark)](#role-colours-switch-between-light-and-dark)
- [Brand colours (the same in both modes)](#brand-colours-the-same-in-both-modes)
- [Customising the colours](#customising-the-colours)

---

The components no longer use Tailwind's own colours such as `gray-200` or
`blue-950`. Instead, the bundle defines its own named colours, based on the
tbd.be palette, in `assets/styles/theme.css`. Every name starts with `tbd-`.

The file is imported in `app.css` right after Tailwind, see
[Installation, step 3.4](installation.md#34-tailwind-css-flowbite-and-turbo);
the Flex recipe adds that line. Without the import the `tbd-*` colours do
not exist and the components render without colours.

## Colours, not extra classes

`theme.css` adds colours to Tailwind's palette, the same way `gray-200`
or `blue-950` are part of it. It does not add separate classes. Each colour
is a CSS variable, for example `--color-tbd-surface`, and Tailwind turns it
into the usual colour utilities:

| Utility | Example |
|---|---|
| Background | `bg-tbd-surface` |
| Text | `text-tbd-ink` |
| Border | `border-tbd-line`, `border-b-tbd-line` |
| Divider | `divide-tbd-line` |
| Ring and ring offset | `ring-tbd-accent`, `ring-offset-tbd-canvas` |
| SVG fill | `fill-tbd-ink` |

Variants (`hover:`, `focus-visible:`, `aria-[current=page]:`, …) and
opacity modifiers (`bg-tbd-accent/15`) work as with any other colour.

The `tbd-` prefix keeps these colours apart from your project's own colours
such as `primary` or `dark`, and shows that a colour comes from the bundle.

## Light and dark mode without `dark:`

`theme.css` gives every colour a light value on `:root` and a dark value
under `html.dark`. Because the utilities refer to the variable,
`bg-tbd-surface` is white in light mode and navy in dark mode. You write
one class instead of a pair:

```twig
{# 1.x #}
<div class="bg-white text-blue-950 border-gray-200 dark:bg-gray-800 dark:text-gray-100 dark:border-gray-700">

{# 2.x #}
<div class="bg-tbd-surface text-tbd-ink border-tbd-line">
```

Do not combine a `tbd-*` colour with a `dark:` colour on the same
property: the `dark:` class would override the token's dark value.

## Using the colours in your own templates

The colours are available in your project templates as well, so your own
markup can match the components:

```twig
<div class="rounded border border-tbd-line bg-tbd-surface p-4">
    <h2 class="text-tbd-ink">Order 1024</h2>
    <p class="text-tbd-ink-muted">Placed on 22 October</p>
    <a href="#" class="text-tbd-accent hover:text-tbd-accent-strong">View invoice</a>
    <span class="rounded-full border border-tbd-success-line bg-tbd-success-soft px-2 text-tbd-success-ink">Paid</span>
</div>
```

Pair them as in the tables below. Every text pair reaches WCAG AA
(4.5:1) and every state indicator 3:1, in both modes.

## Role colours (switch between light and dark)

| Colour | Light | Dark | Use for |
|---|---|---|---|
| `tbd-canvas` | `#FAFAFA` | `#0c1827` | Page background |
| `tbd-surface` | `#FFFFFF` | `#12253C` | Cards, navbar, sidebar, tables, dropdowns, modals, tooltip text |
| `tbd-tint` | navy 4 % | white 5 % | Hover background, sub sections |
| `tbd-tint-strong` | navy 10 % | white 10 % | Active or selected item, grey badge |
| `tbd-line` | `#dee2e6` | `#2a3b50` | Borders and dividers |
| `tbd-line-strong` | `#ced4da` | `#364659` | Bottom border of a table head |
| `tbd-ink` | `#12253C` | `#FAFAFA` | Body text, headings, tooltip background |
| `tbd-ink-muted` | `#495057` | `#c1cad5` | Labels, table headings |
| `tbd-ink-subtle` | `#5c636a` | `#a0a8b1` | Hints, "not set" values, icons, checkbox border |
| `tbd-accent` | `#3263A5` (blue) | `#C1A956` (gold) | Links, active tab, checked checkbox, focus ring |
| `tbd-accent-strong` | `#284f84` | `#d4c389` | Hover of links, active nav item, text on `bg-tbd-accent/15` |
| `tbd-on-accent` | `#FFFFFF` | `#12253C` | Text on a `bg-tbd-accent` fill |
| `tbd-gold-ink` | `#6b5c2b` | `#d4c389` | Text on `bg-tbd-gold/20` (gold badge) |
| `tbd-danger-ink` | `#a51b00` | `#f1aeb5` | Error text and icons |
| `tbd-danger-soft` | `#fcf4f2` | `#30273d` | Error background (alert, toast, badge) |
| `tbd-danger-line` | `#f9c9bf` | `#632b40` | Error border |
| `tbd-success-ink` | `#325e1c` | `#a3cfbb` | Success text and icons |
| `tbd-success-soft` | `#f3faef` | `#133941` | Success background |
| `tbd-success-line` | `#c9e1bd` | `#165648` | Success border |
| `tbd-warning-ink` | `#734c00` | `#ffda6a` | Warning text and icons |
| `tbd-warning-soft` | `#fdf8ed` | `#363c34` | Warning background |
| `tbd-warning-line` | `#f4daa6` | `#716327` | Warning border |

The accent is blue in light mode and gold in dark mode. Gold on white and
blue on navy do not reach the contrast a link or an active state needs.

## Brand colours (the same in both modes)

| Colour | Value | Use for |
|---|---|---|
| `tbd-navy` | `#12253C` | Navy fills, for example the avatar button |
| `tbd-blue` | `#3263A5` | Primary button, with `text-white` |
| `tbd-blue-dark` | `#284f84` | Hover of the primary button |
| `tbd-gold` | `#C1A956` | Gold fills, with `text-tbd-navy` |

## Customising the colours

To use your own colours, override the tokens in your `app.css` after the
import. Override them for both `:root` and `html.dark`, otherwise the light
value is also used in dark mode:

```css
:root {
    --color-tbd-accent: #9e0000;
    --color-tbd-accent-strong: #7a0000;
}

html.dark {
    --color-tbd-accent: #f08a8a;
    --color-tbd-accent-strong: #f5a3a3;
}
```

Check the contrast of your own values against `tbd-surface` and
`tbd-canvas` in both modes: text needs 4.5:1, state indicators 3:1.

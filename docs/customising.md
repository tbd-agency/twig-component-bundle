# Customising the components

[← Back to the README](../README.md)

**On this page**

- [Template blocks](#template-blocks)
- [Variants, types and sizes](#variants-types-and-sizes)

---

The classes of the components come from two places. Change them in your
project, never in `vendor/`.

## Template blocks

Every component reads its classes from a block in
[`templates/default.html.twig`](../templates/default.html.twig), for example
`button_classes`, `card_classes` or `table_cell_classes`. To change them,
create a template that reuses the bundle's template and overrides the
blocks you need:

```twig
{# templates/tbd/default.html.twig #}
{% use '@TbdTwigComponent/default.html.twig' %}

{% block button_classes -%}
    {{ parent() }} rounded-lg
{%- endblock button_classes %}
```

Then point the bundle to it:

```yaml
# config/packages/tbd_twig_component.yaml
tbd_twig_component:
  template: 'tbd/default.html.twig'
```

Blocks you do not override keep the bundle's classes.

## Variants, types and sizes

Variants of `TBD:Button`, `TBD:Badge`, `TBD:Indicator`, and the types of
`TBD:Alert` and `TBD:Toast`, come from the bundle configuration. So do the
sizes and paddings of several components. An entry you add replaces the
default with the same name; the other defaults stay available:

```yaml
tbd_twig_component:
  button:
    variants:
      link: 'text-tbd-accent hover:underline'
  badge:
    default_variant: 'gray'
```

Use the [`tbd-*` colours](colours.md) in your own classes, so light and
dark mode keep working. To list every option with its default value, run:

```bash
php bin/console config:dump-reference tbd_twig_component
```

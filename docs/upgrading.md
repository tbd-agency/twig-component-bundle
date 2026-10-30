# Upgrading

[← Back to the README](../README.md)

## From 2.x to 3.0

Version 3.0 escapes the text the components print. `TBD:Button`,
`TBD:SubTitle`, `TBD:Link`, `TBD:Badge` and `TBD:Tooltip` print their
`label`, `TBD:Toast` its `message`, and `TBD:Detail`, `TBD:Table:Cell` and
`TBD:Table:StickyCell` their `value`, all without `|raw`. Up to 2.x those
props were printed unescaped, so user content reached the page as HTML.

Plain strings are now escaped. `Twig\Markup` is not: the props accept it
next to `string`, and Twig prints it as it is. A `{% set %}` capture is the
only thing that produces Markup, so that is the way to pass HTML.

A filter does not help. Twig marks the output of `ux_icon()`, `|nl2br`,
`|raw` and `|e` as safe where you *print* it; that marking is a compile-time
one and does not travel with the value you pass on as a prop. So
`label="{{ ux_icon('tbd:x') }}"` shows its SVG as text, and
`label="{{ name|e }}"` shows `&amp;lt;b&amp;gt;` — escaped twice. Capture the HTML
you mean to keep, and pass everything else unfiltered.

1. Require the new major version:

   ```bash
   composer require "tbd/twig-component-bundle:^3.0"
   ```

2. Remove the compiled Twig templates, for the same reason as in the
   1.x upgrade below:

   ```bash
   rm -rf var/cache/*/twig
   ```

3. Find the places where you pass HTML as a string. Those now show their
   tags on the page:

   ```bash
   grep -rnE "(label|message|value)=\"[^\"]*(<|ux_icon)" templates/
   ```

   Wrap each one in a capture, which makes it Markup again:

   ```twig
   {# 2.x #}
   <twig:TBD:SubTitle label="<strong>{{ user.name }}</strong>"/>

   {# 3.0 #}
   {% set label %}<strong>{{ user.name }}</strong>{% endset %}
   <twig:TBD:SubTitle :label="label"/>
   ```

   The capture escapes `user.name` on its own, so this is also the fix for
   the user content that used to go in unescaped.

4. Drop the `|e` you added to keep user content safe. The component now
   escapes it, so the filter escapes it a second time and the entities end
   up on the page:

   ```bash
   grep -rnE "(label|message|value)=\"[^\"]*\|e[ }]" templates/
   ```

5. Mind that `label="text {{ var }}"` is a concatenation, not a single
   expression: it is a plain string, even when `var` is Markup. Pass a
   capture instead when the result has to stay HTML.

`TBD:Navbar` keeps printing its `userDropdown` block with `|raw`. That is
the component's own block output, not a prop, so no project data passes
through it.

## From 1.x to 2.0

Version 2.0 colours the components through the `tbd-*` tokens, so every
project needs the `theme.css` import. Blocks you override in your own
template keep their classes; blocks you do not override switch to the
tbd.be palette.

1. Require the new major version:

   ```bash
   composer require "tbd/twig-component-bundle:^2.0"
   ```

2. Commit, then apply the 2.0 recipe. `recipes:update` refuses to run with
   uncommitted changes. It adds the `theme.css` import to
   `assets/styles/app.css`:

   ```bash
   composer recipes:update tbd/twig-component-bundle
   ```

3. Remove the compiled Twig templates:

   ```bash
   rm -rf var/cache/*/twig
   ```

   Composer keeps the release dates on the bundle's files, which are older
   than templates Twig compiled before the upgrade. Twig then keeps
   serving the 1.x templates. `cache:clear` does not always remove them:
   when the container was just rebuilt, it only warms up the cache.

4. Rebuild your assets, for example with `npm run dev`.

5. If you used the badge variant `orange`, switch to `gold`: the tbd.be
   palette has no orange.

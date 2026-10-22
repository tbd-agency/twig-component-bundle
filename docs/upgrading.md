# Upgrading from 1.x

[← Back to the README](../README.md)

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

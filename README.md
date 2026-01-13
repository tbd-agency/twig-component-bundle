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

Make sure your SSH key has access to the repository.

---

### 2. Install the bundle

Run the following command:

```bash
composer require tbd/twig-component-bundle
```

If Symfony Flex is configured correctly, the recipe will be applied automatically.

---

### 3. Bundle registration
The bundle is automatically registered by Symfony Flex. If you need to verify it manually, it should appear in `config/bundles.php` as:

```php
return [
    // ...
    Tbd\\TbdComponentBundle\\TbdComponentBundle::class => ['all' => true],
];
```

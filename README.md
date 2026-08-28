# Package Skeleton Laravel Livewire

This repository is a customized Laravel package skeleton based on the excellent [Spatie Laravel Package Skeleton](https://github.com/spatie/package-skeleton-laravel).

It is designed to provide a convenient starting point for developing Laravel packages, with additional support and tooling for Livewire, Blade components, and Workbench.

> **This is a customized version of Spatie's Laravel Package Skeleton with additional features and development tools.**

## Customizations

This skeleton keeps the original structure and workflow of Spatie's package skeleton while adding several features specifically for Laravel package development.

### What's Included

* **Package Routes**
  Added support for defining and loading package routes.

* **Livewire Support**
  Added Livewire as a package dependency and registered a dedicated Livewire view namespace.

* **Blade Component Support**
  Added Blade component namespace registration for package view-based components.

* **Customized `SkeletonServiceProvider`**
  Rewritten and extended the package service provider to handle package routes, views, Livewire components, Blade components, publishing, and other package-specific functionality.

* **Workbench Integration**
  Added a Workbench environment for developing and testing the package inside a Laravel application.

* **`abolaradev` CLI**
  Added a custom CLI helper that acts as an alias for `vendor/bin/testbench`, making it easier to run Artisan commands inside the Workbench.

* **Package Component Scaffolding**
  Added custom commands for generating Livewire components, Livewire layouts, and view-based Blade components directly inside the package.

* **Automatic README Generation**
  Added support for generating the final package `README.md` from `README_PACKAGE.md` during the configuration process.

The goal is to provide a package skeleton that preserves the simplicity of the original Spatie template while offering a more convenient development workflow for packages that use Livewire and Blade components.

## Getting Started

Follow these steps to create a new Laravel package using this skeleton.

### 1. Create a new repository

Click the **"Use this template"** button at the top of this repository.

Then select **"Create a new repository"** and create a new repository for your package.

### 2. Clone the repository

Clone the newly created repository to your local machine:

```bash
git clone https://github.com/your-username/your-package.git
```

Then navigate into the package directory:

```bash
cd your-package
```

### 3. Configure the package

Run the configuration script:

```bash
php configure.php
```

The script will ask for the required information and replace the placeholders throughout the package.

To see all available options:

```bash
php configure.php --help
```

### 4. Start creating your package

That's it! Your package is now ready for development.

Have fun creating your Laravel package. 🚀

## Workbench

This skeleton includes a Workbench environment for developing and testing your package inside a Laravel application.

To start the Workbench development environment, run:

```bash
composer run serve
```

This command builds the Workbench environment and starts the Laravel development server.

### `abolaradev`

The `abolaradev` command acts as an alias for `vendor/bin/testbench`.

Instead of running:

```bash
vendor/bin/testbench make:model User
```

you can simply use:

```bash
php abolaradev make:model User
```

This allows you to run Testbench and Laravel Artisan commands inside the Workbench environment and create files such as models, migrations, factories, seeders, commands, and other supported Laravel files.

> **Note:** Commands executed through `abolaradev` create files inside the Workbench environment.

### Creating Components Inside the Package

In addition to the standard Testbench commands, this skeleton provides custom commands for creating components directly inside the package root.

These commands are registered through:

```text
workbench/routes/console.php
```

This allows the `abolaradev` CLI to handle both standard Workbench commands and package-specific component generation commands.

### Livewire Components

Create a Livewire component with:

```bash
php abolaradev make:livewire
```

or:

```bash
php abolaradev livewire:make
```

Livewire components are stored in:

```text
resources/views/livewire
```

inside the package root.

### Livewire Layouts

Create the default Livewire layout with:

```bash
php abolaradev livewire:layout
```

You can also create additional layouts by passing a name:

```bash
php abolaradev livewire:layout admin
```

Package Livewire layouts are stored in:

```text
resources/views/layouts
```

### Blade Components

Create a view-based Blade component with:

```bash
php abolaradev make:component
```

Blade components are stored in:

```text
resources/views/components
```

inside the package root.

## Installation

You can install the package via Composer:

```bash
composer require :vendor_slug/:package_slug
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag=":package_slug-migrations"
```

Then run the migrations:

```bash
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag=":package_slug-config"
```

This is the contents of the published config file:

```php
return [

];
```

Optionally, you can publish the views using:

```bash
php artisan vendor:publish --tag=":package_slug-views"
```

## Usage

```php
$variable = new VendorName\Skeleton();

echo $variable->echoPhrase('Hello, VendorName!');
```

## Testing

Run the test suite with:

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) for information on how to report security vulnerabilities.

## Credits

* [Abolaradev](https://github.com/abolaradev)
* [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

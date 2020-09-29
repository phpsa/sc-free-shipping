# Statamic Siomple Commerce Free Shipping Module

![Statami v3](https://img.shields.io/badge/Statamic-3.0+-FF269E)
![Packagist](https://img.shields.io/packagist/v/phpsa/sc-free-shipping)

A [Simple Commerce](https://doublethree.digital/simple-commerce/about) shipping module to handle free shipping for orders over a set monetory value.

This repository contains the code for the shipping gateway. While the code is open-source, it's important to remember that you'll need to purchase a license before using this addon in production. Licenses cost $5 and can be purchased from the [Statamic Marketplace](https://statamic.com/seller/products/290).

## Installation

Install via the Control Panel or via composer

```bash
composer require phpsa/sc-free-shipping
```

## Configuration

Update the `config/simple-commerce.php` file to add as a shipping method:

```php
'shipping' => [
  'methods' => [
    ...
    \Phpsa\ScFreeShipping\ShippingMethods\FreeShipping::class
  ],
],

```

Publish the Free Shipping configuration file, where you'll be able to update your shipping settings per site.

```bash
php artisan vendor:publish --provider="Phpsa\ScFreeShipping\ServiceProvider" --tag="config"
```

## Security

If you discover any security related issues, please email vxdhost@gmail.com instead of using the issue tracker.

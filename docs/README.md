# Laravel Fluidcoins

[![Latest Version on Packagist](https://img.shields.io/packagist/v/lpmatrix/laravel-fluidcoins.svg?style=flat-square)](https://packagist.org/packages/lpmatrix/laravel-fluidcoins)
[![Total Downloads](https://img.shields.io/packagist/dt/lpmatrix/laravel-fluidcoins.svg?style=flat-square)](https://packagist.org/packages/lpmatrix/laravel-fluidcoins)
![GitHub Actions](https://github.com/lpmatrix/laravel-fluidcoins/actions/workflows/main.yml/badge.svg)

A laravel package to seamlessly integrate into fluidcoins

## Installation

You can install the package via composer:

```bash
composer require lpmatrix/laravel-fluidcoins
```

## Usage/Example
```php
use FluidCoins;

FluidCoins::createNewAddress(['code'=> 'USDT', 'network'=> 'POLYGON']);
```

## Testing

```bash
composer test
```


## Configuration

You can publish the configuration file using this command:

```bash
php artisan LPMatrix:publish --provider="LPMatrix\Fluidcoins\FluidcoinsServiceProvider"
```

A configuration-file named `fluidcoins.php` with some sensible defaults will be placed in your `config` directory:

```php
<?php

return [

    /**
     * Secret Key From FLuidcoins Dashboard
     *
     */
    'secretKey' => getenv('FLUIDCOINS_SECRET_KEY');


];
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email mubaraqsanusi908@gmail.com instead of using the issue tracker.

## Credits

-   [Sanusi Mubaraq](https://github.com/lpmatrix)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

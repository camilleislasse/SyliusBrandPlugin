<p align="center">
    <a href="https://sylius.com" target="_blank">
        <picture>
          <source media="(prefers-color-scheme: dark)" srcset="https://media.sylius.com/sylius-logo-800-dark.png">
          <source media="(prefers-color-scheme: light)" srcset="https://media.sylius.com/sylius-logo-800.png">
          <img alt="Sylius Logo." src="https://media.sylius.com/sylius-logo-800.png">
        </picture>
    </a>
</p>

<h1 align="center">Sylius Brand Plugin</h1>

<p align="center">Inspired by <a href="https://github.com/loevgaard/SyliusBrandPlugin" target="_blank">loevgaard/SyliusBrandPlugin</a></p>



## Installation on an existing Sylius project
Install the plugin via Composer:

  ```bash
composer require acseo/sylius-brand-plugin
  ```

Enable the plugin in your config/bundles.php:

```php
return [
// ...
ACSEO\SyliusBrandPlugin\ACSEOSyliusBrandPlugin::class => ['all' => true],
];
```

Update your Product entity to use the ProductTrait provided by the plugin and implement ProductInterface:
```php
<?php

declare(strict_types=1);

namespace App\Entity\Product;

use ACSEO\SyliusBrandPlugin\Entity\ProductTrait;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Core\Model\Product as BaseProduct;
use ACSEO\SyliusBrandPlugin\Entity\ProductInterface;

#[ORM\Entity]
#[ORM\Table(name: 'sylius_product')]
class Product extends BaseProduct implements ProductInterface
{
    use ProductTrait;
}
```
## Documentation

For a comprehensive guide on Sylius Plugins development please go to Sylius documentation,
there you will find the <a href="https://docs.sylius.com/en/latest/plugin-development-guide/index.html">Plugin Development Guide</a>, that is full of examples.

## Quickstart Installation

Run `composer create-project sylius/plugin-skeleton ProjectName`.

### Traditional

1. From the plugin skeleton root directory, run the following commands:

    ```bash
    $ (cd tests/Application && yarn install)
    $ (cd tests/Application && yarn build)
    $ (cd tests/Application && APP_ENV=test bin/console assets:install public)

    $ (cd tests/Application && APP_ENV=test bin/console doctrine:database:create)
    $ (cd tests/Application && APP_ENV=test bin/console doctrine:schema:create)
    # Optionally load data fixtures
    $ (cd tests/Application && APP_ENV=test bin/console sylius:fixtures:load --no-interaction)
    ```

To be able to set up a plugin's database, remember to configure your database credentials in `tests/Application/.env` and `tests/Application/.env.test`.

2. Run your local server:

      ```bash
      symfony server:ca:install
      APP_ENV=test symfony server:start --dir=tests/Application/public --daemon
      ```

3. Open your browser and navigate to `https://localhost:8000`.

### Docker

1. Execute `make init` to initialize the container and install the dependencies.

2. Execute `make database-init` to create the database and run migrations.

3. (Optional) Execute `make load-fixtures` to load the fixtures.

4. Your app is available at `http://localhost`.

## Usage

### Running plugin tests

  - PHPUnit

    ```bash
    vendor/bin/phpunit
    ```

  - PHPSpec

    ```bash
    vendor/bin/phpspec run
    ```

  - Behat (non-JS scenarios)

    ```bash
    vendor/bin/behat --strict --tags="~@javascript&&~@mink:chromedriver"
    ```

  - Behat (JS scenarios)
 
    1. [Install Symfony CLI command](https://symfony.com/download).
 
    2. Start Headless Chrome:
    
      ```bash
      google-chrome-stable --enable-automation --disable-background-networking --no-default-browser-check --no-first-run --disable-popup-blocking --disable-default-apps --allow-insecure-localhost --disable-translate --disable-extensions --no-sandbox --enable-features=Metal --headless --remote-debugging-port=9222 --window-size=2880,1800 --proxy-server='direct://' --proxy-bypass-list='*' http://127.0.0.1
      ```
    
    3. Install SSL certificates (only once needed) and run test application's webserver on `127.0.0.1:8080`:
    
      ```bash
      symfony server:ca:install
      APP_ENV=test symfony server:start --port=8080 --dir=tests/Application/public --daemon
      ```
    
    4. Run Behat:
    
      ```bash
      vendor/bin/behat --strict --tags="@javascript,@mink:chromedriver"
      ```
    
  - Static Analysis
      
    - PHPStan
    
      ```bash
      vendor/bin/phpstan analyse -c phpstan.neon -l max src/  
      ```

  - Coding Standard
  
    ```bash
    vendor/bin/ecs check
    ```

### Opening Sylius with your plugin

- Using `test` environment:

    ```bash
    (cd tests/Application && APP_ENV=test bin/console sylius:fixtures:load)
    (cd tests/Application && APP_ENV=test bin/console server:run -d public)
    ```
    
- Using `dev` environment:

    ```bash
    (cd tests/Application && APP_ENV=dev bin/console sylius:fixtures:load)
    (cd tests/Application && APP_ENV=dev bin/console server:run -d public)
    ```

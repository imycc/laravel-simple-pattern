# Laravel Simple Pattern

Laravel Simple Pattern let us easily to create desgin pattern and its interface in laravel.

## Installation

### Composer

Execute the following command to get the latest version of the package:

```terminal
composer require imycc/laravel-simple-pattern
```

### Laravel

We need to copy some file to laravel first.
```php
php artisan vendor:publish --provider="LaravelSimplePattern\LspServiceProvider" --tag="install"
```

#### >= laravel 5.7

In your `config/app.php` add `App\Providers\RepositoryServiceProvider::class` to the end of the `providers` array:

```php
'providers' => [
    ...
    App\Providers\RepositoryServiceProvider::class,
],
```

#### Other

In your `config/app.php` add `LaravelSimplePattern\LspServiceProvider::class` and `App\Providers\RepositoryServiceProvider::class` to the end of the `providers` array:

```php
'providers' => [
    ...
    LaravelSimplePattern\LspServiceProvider::class,
    App\Providers\RepositoryServiceProvider::class
],
```

### Usage

We must give -b flag for binding repository and its interface in RepositoryServicePorvider.

```php
php artisan make:repo DummyRepository -i -b
```


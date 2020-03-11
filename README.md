# Laravel Simple Repo

Laravel Simple Repo(LSR) let us easily to create repository and its interface in laravel.

## Installation

### Composer

Execute the following command to get the latest version of the package:

```terminal
composer require lsr/laravel-simple-repo
```

### Laravel

#### >= laravel5.7

In your `config/app.php` add `App\Providers\RepositoryServiceProvider::class` to the end of the `providers` array:

```php
'providers' => [
    ...
    App\Providers\RepositoryServiceProvider::class,
],
```

#### Other

In your `config/app.php` add `LaravelSimpleRepo\LsrServiceProvider::class` and `App\Providers\RepositoryServiceProvider::class` to the end of the `providers` array:

```php
'providers' => [
    ...
    LaravelSimpleRepo\LsrServiceProvider::class,
    App\Providers\RepositoryServiceProvider::class
],
```

#### Usage
We must give -b flag for binding repository and its interface in RepositoryServicePorvider.

```php
php artisan make:repo DummyRepository -i -b
```


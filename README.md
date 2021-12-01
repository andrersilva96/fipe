<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

After clone please run:

Copy the .env.example to .env.

**With Docker:**

```
$ docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php80-composer:latest \
    composer install --ignore-platform-reqs

$ sail php artisan key:generate
$ sail php artisan migrate --seed
```

**Without Docker (Only PHP with Composer):**

```
$ composer install --optimize-autoloader --no-dev \
&& php artisan key:generate \
&& php artisan migrate --seed
```

Creating a new module:

1. Copy and Paste the Folder from Modules\Example
2. Inside module.json change the index name to respective module. 

To update prod server please run:

```
$ git pull \
&& composer install --no-dev \
&& php artisan config:cache \
&& php artisan route:cache \
&& php artisan view:cache \
&& php artisan migrate
```

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Installation

## Setup this repository first

Usage

```bash
git clone https://github.com/danixsofyan/assets
cd assets
```

## Setup Laravel Packages and Migrations

### Make sure you do this before setup on bash

-   PHP version is on version 8.2
-   .env File is available or exists
-   Change database config on .env file
-   Composer installed

### Bash Usage

```bash
composer install
cp .env.example .env
php artisan key:generate
npm install
php artisan migrate:fresh --seed
npm run build
php artisan serve
```

### DEMO

```bash
https://assets.laravel.cloud/
E : dani@codelogy.dev
P : 123qweasd
```

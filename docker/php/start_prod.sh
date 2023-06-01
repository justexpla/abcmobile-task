#!/bin/bash

composer install --no-dev
php artisan migrate
php artisan optimize
php-fpm

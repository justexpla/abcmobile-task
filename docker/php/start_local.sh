#!/bin/bash

composer install
php artisan migrate
php artisan optimize
php-fpm
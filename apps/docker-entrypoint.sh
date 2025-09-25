#!/bin/sh
set -e

# Iniciar PHP-FPM em background
php-fpm -D

# Iniciar nginx em foreground
nginx -g 'daemon off;'

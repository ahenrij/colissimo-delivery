#! /bin/bash

PROD_ENV=false

while getopts 'p' opt; do
    case $opt in
        p) PROD_ENV=true ;;
        *) echo 'Error in command line parsing' >&2
            exit 1
    esac
done

composer install
php artisan key:generate
php artisan migrate --seed

if "$PROD_ENV"; then
    cp -f .env.prod .env
    rm -f .env.prod
    php artisan optimize:clear
fi
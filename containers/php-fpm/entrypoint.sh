#!/usr/bin/env bash

echo "Composer update & install"
composer install

echo "Yarn install & build"
yarn install
yarn build

echo "Lance les migrations"
symfony console doctrine:migrations:migrate -n

php-fpm
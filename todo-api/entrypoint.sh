#!/bin/sh

echo "Aguardando MySQL subir..."

until mysqladmin ping -h mysql-todo -u root -proot --silent; do
  echo "Aguardando MySQL subir..."
  sleep 2
done

php artisan migrate --force

exec php-fpm

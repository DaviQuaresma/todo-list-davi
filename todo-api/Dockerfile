FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip \
    libzip-dev libpq-dev mariadb-client netcat-openbsd && \
    docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl

COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN composer install --no-interaction --prefer-dist --optimize-autoloader
RUN chmod -R 777 storage bootstrap/cache

RUN php artisan config:clear && \
    php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache

COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh
ENTRYPOINT ["/entrypoint.sh"]

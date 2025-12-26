FROM php:8.4-apache
RUN apt-get update && apt-get install -y curl unzip
RUN docker-php-ext-install pdo pdo_mysql
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/html
COPY . .
RUN composer install --no-dev --optimize-autoloader
RUN echo "APP_ENV=production" > .env && php artisan key:generate --force
EXPOSE 80
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=80"]

FROM php:8.3-cli

# System dependencies
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpq-dev libzip-dev libpng-dev libonig-dev \
    && docker-php-ext-install pdo pdo_pgsql pgsql zip gd mbstring bcmath \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist

COPY . .

RUN composer dump-autoload --optimize --no-dev

RUN npm ci && npm run build

RUN mkdir -p storage/framework/{cache,sessions,views} storage/logs bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 10000

CMD php artisan migrate --force && \
    php artisan storage:link || true && \
    php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    php artisan serve --host=0.0.0.0 --port=${PORT:-10000}

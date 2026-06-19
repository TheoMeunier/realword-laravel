# ─── Deps ─────────────────────────────────────────────────────────────────────
FROM composer:latest AS composer

WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --no-scripts \
    --no-interaction \
    --no-progress \
    --prefer-dist \
    --optimize-autoloader

COPY . .
RUN composer dump-autoload --optimize --classmap-authoritative --no-dev

# ─── Production ───────────────────────────────────────────────────────────────
FROM dunglas/frankenphp:1-php8.4-alpine AS production

ARG APP_ENV=production

ENV APP_ENV=${APP_ENV} \
    APP_RUNNING_IN_CONTAINER=true \
    OCTANE_SERVER=frankenphp

WORKDIR /var/www

RUN install-php-extensions \
    pdo_pgsql \
    pgsql \
    gd \
    intl \
    zip \
    bcmath \
    pcntl \
    opcache \
    exif

COPY docker/prod/php.ini $PHP_INI_DIR/conf.d/99-app.ini
COPY docker/prod/Caddyfile /etc/caddy/Caddyfile

COPY --from=composer /app/vendor/             /var/www/vendor/
COPY --from=composer /app/bootstrap/          /var/www/bootstrap/
COPY --from=composer /app/app/                /var/www/app/
COPY --from=composer /app/database/           /var/www/database/
COPY --from=composer /app/config/             /var/www/config/
COPY --from=composer /app/routes/             /var/www/routes/
COPY --from=composer /app/resources/views/    /var/www/resources/views/
COPY --from=composer /app/public/             /var/www/public/
COPY --from=composer /app/storage/            /var/www/storage/
COPY --from=composer /app/artisan             /var/www/artisan
COPY --from=composer /app/composer.json       /var/www/composer.json

RUN php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache \
    && php artisan event:cache

RUN chown -R 1000:1000 /var/www/storage /var/www/bootstrap/cache

USER 1000

EXPOSE 8080

HEALTHCHECK --interval=30s --timeout=5s --start-period=15s --retries=3 \
    CMD wget -qO- http://localhost:8080/up || exit 1

ENTRYPOINT ["php", "artisan", "octane:frankenphp", \
    "--host=0.0.0.0", \
    "--port=8080", \
    "--workers=auto", \
    "--max-requests=500"]

FROM dunglas/frankenphp:1-php8.4 AS production

# Copy composer.lock and composer.json
COPY composer.lock composer.json /var/www/

# Set working directory
WORKDIR /var/www

ENV APP_RUNNING_IN_CONTAINER=true \
    PHP_OPCACHE_ENABLE=1 \
    PHP_OPCACHE_VALIDATE_TIMESTAMPS=0 \
    OCTANE_SERVER=frankenphp

# Get nodejs
RUN curl -fsSL https://deb.nodesource.com/setup_lts.x | bash -

RUN apt-get update && apt-get install -y nodejs

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

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Change current user to www
USER www

# Expose port 8080 and start server
EXPOSE 8080

ENTRYPOINT ["php", "artisan", "octane:frankenphp", "--host=0.0.0.0", "--port=8080", "--watch"]

FROM php:8.3-cli

RUN apt-get update && apt-get install -y \
    git unzip curl libpq-dev zip libzip-dev \
    && docker-php-ext-install pdo pdo_pgsql zip \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN groupadd -g 1000 devuser \
    && useradd -m -u 1000 -g 1000 -s /bin/bash devuser \
    && echo "devuser ALL=(ALL) NOPASSWD: ALL" >> /etc/sudoers


RUN mkdir -p /var/www/storage /var/www/bootstrap/cache \
    && chown -R devuser:devuser /var/www/storage /var/www/bootstrap/cache \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

USER devuser

WORKDIR /var/www

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

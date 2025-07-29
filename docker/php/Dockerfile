FROM php:8.3-cli

# Instalar dependencias, extensiones y phpredis
RUN apt-get update && apt-get install -y \
    git unzip curl libpq-dev zip libzip-dev \
    && docker-php-ext-install pdo pdo_pgsql zip \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN groupadd -g 1000 devuser \
    && useradd -m -u 1000 -g 1000 -s /bin/bash devuser \
    && echo "devuser ALL=(ALL) NOPASSWD: ALL" >> /etc/sudoers

# Cambiar usuario por defecto
USER devuser

# Establecer directorio de trabajo
WORKDIR /var/www

# Instala Composer copiándolo de la imagen oficial de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

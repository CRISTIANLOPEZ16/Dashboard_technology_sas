FROM php:8.4-fpm

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    libpq-dev \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar directorio de trabajo
WORKDIR /var/www/html

# Instalar PHPUnit y Doctrine
COPY composer.json /var/www/html/
RUN composer install
EXPOSE 8000
CMD ["php", "-S", "0.0.0.0:8000", "-t", "."]

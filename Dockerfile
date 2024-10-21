# Dockerfile para Laravel 9 (Api)
FROM php:8.1-apache

# Instalar extensiones de PHP necesarias
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    nano \
    && docker-php-ext-install pdo_mysql zip

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Copiar los archivos de la aplicación Laravel
COPY . /var/www/html

# Instalar las dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader

# Cambiar permisos de las carpetas de Laravel necesarias
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Habilitar el módulo de reescritura de Apache
RUN a2enmod rewrite

# Comando de inicio por defecto
CMD ["apache2-foreground"]

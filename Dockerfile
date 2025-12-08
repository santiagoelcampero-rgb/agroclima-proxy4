FROM php:8.2-apache

# Instalar dependencias necesarias para composer
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Habilitar módulos PHP
RUN docker-php-ext-install pdo pdo_mysql

# Copiar archivos al servidor Apache
COPY . /var/www/html/

# Dar permisos
RUN chown -R www-data:www-data /var/www/html

# Instalar dependencias PHP del proyecto
RUN composer install --no-dev --optimize-autoloader

EXPOSE 80

CMD ["apache2-foreground"]

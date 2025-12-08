FROM php:8.2-apache

# Instalar Composer dentro del contenedor
RUN apt-get update && apt-get install -y unzip \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Habilitar módulos necesarios
RUN docker-php-ext-install pdo pdo_mysql

# Copiar archivos al contenedor
COPY . /var/www/html/

# Instalar dependencias de Composer dentro del contenedor
RUN cd /var/www/html && composer install

# Dar permisos
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80

CMD ["apache2-foreground"]

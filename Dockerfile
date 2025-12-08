FROM php:8.2-apache

# Habilitar módulos necesarios
RUN docker-php-ext-install pdo pdo_mysql

# Copiar los archivos del proyecto al servidor Apache
COPY . /var/www/html/

# Dar permisos
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80

# Iniciar Apache
CMD ["apache2-foreground"]

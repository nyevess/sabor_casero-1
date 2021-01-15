#imagen por defecto de php
FROM php:7.4-apache

# copiamos todo el contenido de la carpta www
# a la carpeta del conteneodor /var/www/html
# dentro de la carpeta www tenemos los archivos
# del proyecto php
COPY ./www /var/www/html
# extensiones de php
RUN docker-php-ext-install mysqli pdo pdo_mysql

# cambiamos al directorio de trabajo
WORKDIR /var/www/html

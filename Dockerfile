# Dockerfile
FROM php:8.2-apache

# Instalar dependencias del sistema y extensiones para Postgres
RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install pdo pdo_pgsql pgsql

# Copiar los archivos de la API al directorio web del servidor
COPY api/ /var/www/html/

# Habilitar mod_rewrite
RUN a2enmod rewrite

# Opcional: ajustar permisos si es necesario
# RUN chown -R www-data:www-data /var/www/html

EXPOSE 80

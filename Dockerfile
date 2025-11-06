# Imagen base con Apache y PHP 8.2
FROM php:8.2-apache

# Instalar dependencias del sistema y extensiones de PHP
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Copiar archivos del proyecto
COPY . .

# Instalar dependencias de Laravel (sin interacción)
RUN composer install --no-interaction --optimize-autoloader

# Asignar permisos
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Habilitar mod_rewrite
RUN a2enmod rewrite

# Variable de entorno para Render
ENV PORT=8080

# Configurar Apache para escuchar el puerto que Render asigne
RUN sed -i "s/80/${PORT}/g" /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf

# Exponer el puerto dinámico
EXPOSE 8080

# Comando de inicio
CMD ["apache2-foreground"]

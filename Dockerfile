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

# Asignar permisos a las carpetas necesarias
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Habilitar mod_rewrite (necesario para Laravel o rutas limpias)
RUN a2enmod rewrite

# Configurar Apache para usar el puerto asignado por Render
ENV PORT=10000
EXPOSE 10000

# Actualizar configuración de Apache para escuchar ese puerto
RUN sed -i "s/80/\${PORT}/g" /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf

# Iniciar Apache en primer plano
CMD ["apache2-foreground"]

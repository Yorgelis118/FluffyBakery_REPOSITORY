FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-interaction --optimize-autoloader

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

RUN a2enmod rewrite

# ============================
# 🔥 USAR PUERTO DINÁMICO REAL
# ============================
RUN rm /etc/apache2/ports.conf
RUN rm /etc/apache2/sites-available/000-default.conf

# Crear puertos dinámicos en tiempo de ejecución
RUN echo "Listen \${PORT}" > /etc/apache2/ports.conf

# Reemplazar virtualhost correcto
RUN printf "<VirtualHost *:\${PORT}>\n\
    DocumentRoot /var/www/html/public\n\
    <Directory /var/www/html/public>\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
</VirtualHost>\n" > /etc/apache2/sites-available/000-default.conf

EXPOSE 8080

CMD ["apache2-foreground"]

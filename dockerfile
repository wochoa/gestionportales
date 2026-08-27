FROM php:7.4-fpm

# Instalar dependencias del sistema, herramientas y librerías de desarrollo de Postgres
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libpq-dev

# Limpiar caché del gestor de paquetes
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Configurar e instalar extensión GD (Requerido por Intervention Image)
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

# Instalar extensiones PHP esenciales (Cambiado pdo_mysql por pdo_pgsql y pgsql)
RUN docker-php-ext-install pdo_pgsql pgsql mbstring exif pcntl bcmath

# Instalar Composer v2.2 (LTS compatible con Laravel 7)
COPY --from=composer:2.2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
COPY . /var/www

# Permisos correctos para carpetas de escritura
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]

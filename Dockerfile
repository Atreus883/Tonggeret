# Gunakan image resmi PHP 8.1 dengan Apache
FROM php:8.1-apache

# --- INSTALASI DEPENDENSI SISTEM ---
RUN apt-get update && apt-get install -y \
    build-essential \
    git \
    curl \
    libzip-dev \
    libicu-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    && rm -rf /var/lib/apt/lists/*

# --- INSTALASI EKSTENSI PHP ---
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN a2enmod rewrite
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
# Tambahkan 'mysqli' pada baris di bawah ini
RUN docker-php-ext-install pdo pdo_mysql mysqli intl zip gd

# --- KONFIGURASI APACHE ---
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# --- PERSIAPAN APLIKASI ---
WORKDIR /var/www/html
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader
COPY . .

# --- FINALISASI PERIZINAN ---
RUN chown -R www-data:www-data /var/www/html/writable
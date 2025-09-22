# Gunakan image resmi PHP 8.1 dengan Apache
FROM php:8.1-apache

# --- INSTALASI DEPENDENSI SISTEM ---
# Install library-library yang dibutuhkan oleh ekstensi PHP di bawah
# - build-essential, git, curl, libzip-dev: Alat-alat umum
# - libicu-dev: Untuk ekstensi 'intl'
# - libpng-dev, libjpeg-dev, libfreetype6-dev: Untuk ekstensi 'gd'
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
# 1. Install Composer (dependency manager untuk PHP)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 2. Aktifkan modul rewrite Apache untuk URL cantik CodeIgniter
RUN a2enmod rewrite

# 3. Konfigurasi ekstensi 'gd' agar menggunakan library yang sudah diinstall
RUN docker-php-ext-configure gd --with-freetype --with-jpeg

# 4. Install ekstensi-ekstensi PHP yang dibutuhkan
RUN docker-php-ext-install pdo pdo_mysql intl zip gd

# --- KONFIGURASI APACHE ---
# Ubah DocumentRoot Apache agar menunjuk ke folder /public
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# --- PERSIAPAN APLIKASI ---
# 1. Tetapkan direktori kerja utama
WORKDIR /var/www/html

# 2. Salin file definisi dependensi terlebih dahulu
COPY composer.json composer.lock ./

# 3. Jalankan composer install untuk membuat folder /vendor
RUN composer install --no-dev --optimize-autoloader

# 4. Salin sisa file aplikasi Anda
COPY . .
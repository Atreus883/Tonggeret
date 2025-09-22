# Gunakan image resmi PHP 8.1 dengan Apache
FROM php:8.1-apache

# --- INSTALASI ALAT YANG DIBUTUHKAN ---
# 1. Install Composer (dependency manager untuk PHP)
# Cara modern dan bersih untuk mendapatkan Composer di Docker
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 2. Aktifkan modul rewrite Apache untuk URL cantik CodeIgniter
RUN a2enmod rewrite

# 3. Install ekstensi PHP yang dibutuhkan untuk terhubung ke Database
RUN docker-php-ext-install pdo pdo_mysql

# --- KONFIGURASI APACHE ---
# Ubah DocumentRoot Apache agar menunjuk ke folder /public
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# --- PERSIAPAN APLIKASI ---
# 1. Tetapkan direktori kerja utama
WORKDIR /var/www/html

# 2. Salin file definisi dependensi terlebih dahulu
# Ini trik agar Docker bisa menggunakan cache dan mempercepat build selanjutnya
COPY composer.json composer.lock ./

# 3. Jalankan composer install untuk membuat folder /vendor
# Opsi --no-dev memastikan hanya library untuk production yang diinstall
RUN composer install --no-dev --optimize-autoloader

# 4. Salin sisa file aplikasi Anda
COPY . .
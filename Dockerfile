# Gunakan image resmi PHP 8.1 dengan Apache
FROM php:8.1-apache

# --- INSTALASI ALAT YANG DIBUTUHKAN ---
# 1. Install Composer (dependency manager untuk PHP)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 2. Aktifkan modul rewrite Apache untuk URL cantik CodeIgniter
RUN a2enmod rewrite

# 3. Install ekstensi PHP yang dibutuhkan
#    pdo_mysql: untuk database
#    intl: untuk internationalization (sering dibutuhkan framework)
#    zip: untuk menangani file zip (dibutuhkan oleh composer)
#    gd: untuk manipulasi gambar
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
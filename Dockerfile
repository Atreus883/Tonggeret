# Gunakan image resmi PHP 8.1 dengan Apache
FROM php:8.1-apache

# Aktifkan modul rewrite untuk CodeIgniter's pretty URLs
RUN a2enmod rewrite

# Install ekstensi PHP yang umum dibutuhkan (termasuk untuk MySQL)
RUN docker-php-ext-install pdo pdo_mysql

# Salin semua file proyek Anda ke direktori web server di dalam container
COPY . /var/www/html/

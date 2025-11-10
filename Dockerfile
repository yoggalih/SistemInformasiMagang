# =========================================================
# STAGE 1: Build Aset Frontend (Node.js)
# =========================================================
FROM node:20-alpine as node_builder
WORKDIR /app
# Salin konfigurasi Node (package.json dan lock file)
COPY package.json package-lock.json ./
# Instal semua dependensi Node.js (termasuk tailwind dan vite)
RUN npm install
# Salin aset source dan konfigurasi vite
COPY resources/css resources/css
COPY resources/js resources/js
COPY vite.config.js .
# Jalankan build aset ke public/build
RUN npm run build --mode production

# =========================================================
# STAGE 2: Build Aplikasi PHP Final (PHP FPM)
# =========================================================
FROM php:8.2-fpm-alpine as php_builder

# Instal dependensi sistem dan ekstensi PHP
RUN apk update && apk add --no-cache \
    git \
    $PHPIZE_DEPS \
    icu-dev \
    libxml2-dev \
    onigur-dev \
    zip-dev \
    openssl \
    mysql-client \
    # Tambahkan dependensi GCS/S3
    curl \
    # Instal ekstensi PHP
    && docker-php-ext-install -j$(nproc) pdo_mysql mbstring tokenizer xml zip bcmath \
    && docker-php-ext-enable opcache \
    && apk del $PHPIZE_DEPS

# Instal Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Atur direktori kerja
WORKDIR /var/www/html

# Salin source code aplikasi
COPY . .

# Instal dependensi PHP Composer (production only)
RUN composer install --optimize-autoloader --no-dev --no-interaction

# Optimasi Laravel: Cache konfigurasi
RUN php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

# Atur permissions (storage/ akan di-mount ke /tmp di Cloud Run)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Salin aset yang sudah di-build dari Stage 1
COPY --from=node_builder /app/public/build /var/www/html/public/build

# Expose port (8080 adalah default untuk Cloud Run)
EXPOSE 8080

# Jalankan PHP-FPM di foreground
CMD ["php-fpm", "-F"]
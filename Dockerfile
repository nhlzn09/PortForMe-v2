FROM php:8.4-cli

RUN apt-get update && apt-get install -y --no-install-recommends \
      git unzip libzip-dev libpng-dev libjpeg-dev libwebp-dev libfreetype6-dev \
 && docker-php-ext-configure gd --with-jpeg --with-webp --with-freetype \
 && docker-php-ext-install -j"$(nproc)" gd pdo_mysql zip bcmath exif \
 && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN printf "upload_max_filesize=8M\npost_max_size=40M\nmemory_limit=256M\n" > /usr/local/etc/php/conf.d/uploads.ini

WORKDIR /app
COPY . .
RUN composer install --no-dev --optimize-autoloader --no-interaction \
 && chmod +x start.sh \
 && mkdir -p storage/framework/{cache,sessions,views} storage/logs bootstrap/cache \
 && chmod -R 777 storage bootstrap/cache

ENV PHP_CLI_SERVER_WORKERS=4
CMD ["./start.sh"]

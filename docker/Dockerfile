FROM serversideup/php:8.5-fpm-nginx

ENV PHP_OPCACHE_ENABLE=1

USER root

RUN curl -sL https://deb.nodesource.com/setup_20.x | bash -
RUN apt-get install -y nodejs

WORKDIR /var/www/html

COPY . .

RUN npm install
RUN npm run build && rm -rf node_modules

RUN composer install --no-interaction --no-dev --optimize-autoloader

RUN mkdir -p ./storage/app/public/lyrics

RUN chown -R www-data:www-data /var/www/html

RUN mkdir -p /etc/entrypoint.d \
    && cp /var/www/html/docker/entrypoint.sh /etc/entrypoint.d/laravel-init.sh \
    && chmod +x /etc/entrypoint.d/laravel-init.sh

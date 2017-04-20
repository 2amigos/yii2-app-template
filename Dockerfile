FROM dmstr/php-yii2:7.1-fpm-3.0-beta3-alpine-nginx-xdebug

COPY . /app

RUN cp .env.example .env
RUN chown www-data /app/public/assets

COPY image-files /

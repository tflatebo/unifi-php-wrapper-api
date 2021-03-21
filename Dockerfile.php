FROM composer:latest as builder

WORKDIR /tmp
COPY . /tmp

COPY composer.json composer.json
COPY composer.lock composer.lock

RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist

FROM bitnami/php-fpm:latest
COPY --from=builder /tmp /app
WORKDIR /app
# udpate the www-data user to be uid and gid of 33 to match debian
RUN chmod -R 777 /app/storage/logs
EXPOSE 9000
CMD ["php-fpm", "-F", "--pid" , "/opt/bitnami/php/tmp/php-fpm.pid", "-c", "/opt/bitnami/php/conf/php-fpm.conf"]

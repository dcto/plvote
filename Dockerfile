FROM php:7.4
MAINTAINER dc.To sdoz@live.com
ENV TZ=Asia/Shanghai

RUN apt-get update && apt-get install -y \
        --no-install-recommends libfreetype6-dev libjpeg62-turbo-dev libpng-dev curl \
    && apt-get install zlib1g-dev \
    && apt-get install zip unzip

RUN pecl install redis \
    && docker-php-ext-install bcmath \
	&& docker-php-ext-enable redis bcmath

RUN curl -o /usr/bin/composer https://mirrors.aliyun.com/composer/composer.phar \
    && chmod +x /usr/bin/composer

RUN rm -rf /var/www/plvote \
    && mkdir -p /var/www/plvote

COPY * /var/www/plvote

WORKDIR /var/www/plvote

RUN composer update
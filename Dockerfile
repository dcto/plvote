FROM php:7.4
MAINTAINER dc.To sdoz@live.com
ENV TZ=Asia/Shanghai

RUN apt-get update && apt-get install -y \
        --no-install-recommends libfreetype6-dev libjpeg62-turbo-dev libpng-dev curl \
    && apt-get install zlib1g-dev \
    && apt-get install zip unzip

RUN pecl install redis \
    && docker-php-ext-install bcmath \
    && docker-php-ext-install pdo_mysql \
	&& docker-php-ext-enable redis bcmath pdo_mysql

RUN curl -o /usr/bin/composer https://mirrors.aliyun.com/composer/composer.phar \
    && chmod +x /usr/bin/composer
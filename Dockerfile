FROM php:8.4.5-bookworm

EXPOSE 8000

ENV APP_ENV="development"

WORKDIR /var/www/html/rackforest

COPY . .

RUN apt-get update &&\
    apt-get install -y git zip

RUN curl -o composer-setup.php -L https://raw.githubusercontent.com/composer/getcomposer.org/7b977730bcee2bea2a9581d0fca898b352c3cd74/web/installer &&\
    php composer-setup.php --version=2.8.8 &&\
    mv composer.phar /usr/local/bin/composer &&\
    rm composer-setup.php

CMD ["php", "-S", "0.0.0.0:8000", "public/index.php"]

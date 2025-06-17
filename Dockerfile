FROM laravelsail/php83-composer

RUN apt-get update \
    && apt-get install -y libicu-dev \
    && docker-php-ext-install intl

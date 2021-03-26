FROM angelgallegos/php-cli:${BASE_VERSION}

MAINTAINER Angel Gallegos <angel.gallegos.andrade@gmail.com>

WORKDIR /tmp

#Install
RUN apt-get update -y \
&& apt-get install -y \
    php7.4-mongodb \
    php7.4-mysql \
    php7.4-pgsql \
    php7.4-redis \
    php7.4-sqlite3 \
    imagemagick \
    php7.4-imagick \
    php7.4-gd \
    php7.4-curl \
    php7.4-xml \
    php7.4-soap \
    php7.4-bcmath \
    libmcrypt-dev \
&& apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN mkdir -p /data/www
WORKDIR /data/www
ENV PATH=/data/www/vendor/bin:$PATH

ENTRYPOINT ["/sbin/my_init", "--"]
CMD ["php"]
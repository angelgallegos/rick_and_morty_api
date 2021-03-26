FROM angelgallegos/php-cli:${BASE_VERSION}

MAINTAINER Angel Gallegos <angel.gallegos.andrade@gmail.com>

WORKDIR /tmp

RUN apt-get update -y \
&& apt-get install -y \
   git \
   zip \
   unzip \
   php7.4-zip \
   php7.4-mbstring \
   php-ast \
&& curl -sS https://getcomposer.org/installer | php \
&& mv composer.phar /usr/local/bin/composer \
&& composer self-update \
&& apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN mkdir -p /data/www
WORKDIR /data/www
ENV COMPOSER_HOME=/data

ENTRYPOINT ["/sbin/my_init", "--", "composer"]
CMD ["--help"]
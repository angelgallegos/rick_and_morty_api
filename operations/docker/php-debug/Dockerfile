FROM angelgallegos/artisan:${BASE_VERSION}

MAINTAINER Angel Gallegos <angel.gallegos.andrade@gmail.com>

RUN apt-get update -y \
&& apt-get install -y \
   php-ast \
   patch \
   php7.4-xdebug \
&& phpenmod -s cli xdebug \
&& apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

ENTRYPOINT ["/sbin/my_init", "--quiet", "--"]
CMD ["php"]
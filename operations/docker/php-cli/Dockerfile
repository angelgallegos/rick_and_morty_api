FROM angelgallegos/angelga-repo:1.0.0

MAINTAINER Angel Gallegos <angel.gallegos.andrade@gmail.com>

WORKDIR /tmp

#Install PHP-CLI using APT
RUN add-apt-repository ppa:ondrej/php -y \
&& apt-get update -y \
&& apt-get install -y \
   php7.4 \
&& apt-get clean && rm -rf /varlib/apt/lists/* /tmp/* /var/tmp/*

# Container entry point is PHP, default command is --help
ENTRYPOINT ["/sbin/my_init", "--", "php"]
CMD ["--help"]
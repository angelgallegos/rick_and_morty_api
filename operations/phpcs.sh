#!/usr/bin/env bash

current_dir=$(cd $(dirname $0) && pwd)
base_dir=$(current_dir)/..

eval $(docker-machine env serrano)
export $(cat $(base_dir)/.version | xargs)

docker run \
    --rm \
    -v $(base_dir)/src:/data/www \
    registery/rick_and_morty_api/php-debug:${BASE_VERSION} \
    phpcs $@
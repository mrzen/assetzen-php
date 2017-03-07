FROM php:7-alpine
MAINTAINER Leo Adamek <leo.adamek@mrzen.com>

COPY . /usr/src/app
WORKDIR /usr/src/app

ENTRYPOINT ["/usr/src/app/vendor/bin/phpunit"]

FROM ubuntu:latest

ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update

RUN apt-get install -y apache2 php

RUN apt-get install -y php-mysql

RUN phpenmod pdo_mysql

RUN apt-get install -y composer

RUN apt-get install -y php-xdebug

RUN a2enmod rewrite

RUN a2enmod rewrite

COPY ./.docker/php/000-default.conf /etc/apache2/sites-enabled/000-default.conf

#COPY ./.docker/php/apache2.conf /etc/apache2/apache2.conf

WORKDIR /var/www

CMD ["apache2ctl", "-D", "FOREGROUND"]

EXPOSE 80

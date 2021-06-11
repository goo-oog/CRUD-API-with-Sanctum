FROM composer
RUN mkdir -p /app
RUN docker-php-ext-install mysqli pdo pdo_mysql
COPY . /app
WORKDIR /app
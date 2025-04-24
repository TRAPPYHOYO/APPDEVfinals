FROM php:8.3-fpm-alpine

<<<<<<< HEAD
# Install system dependencies
RUN apk add --no-cache \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libxml2-dev \
    oniguruma-dev \
    libzip-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    icu-dev \
    build-base

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath gd intl

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www
=======
# Update and upgrade the Alpine packages
RUN apk update && apk upgrade --no-cache

# Install required dependencies
RUN apk add --no-cache \
    git \
    curl \
    libpng-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    libxpm-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    npm \
    nodejs \
    oniguruma-dev \
    bash \
    build-base \
    autoconf \
    g++ \
    make

# Install PHP extensions
RUN docker-php-ext-configure gd --with-jpeg --with-webp --with-xpm && \
    docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Copy Composer from the official Composer image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set the working directory
WORKDIR /var/www
>>>>>>> 5636c5d13ba2b4d9ccada4d832aebbe4053e63f7

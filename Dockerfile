FROM php:8.2-apache

# Install PHP extensions and other dependencies
RUN docker-php-ext-install mysqli pdo pdo_mysql \
    && a2enmod rewrite

# Install additional dependencies if needed
RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    git \
    && rm -rf /var/lib/apt/lists/*

# Configure Apache
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY src/ /var/www/html/
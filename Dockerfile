# Use an official PHP runtime as a parent image
FROM php:8.2-cli

# Set the working directory in the container
WORKDIR /var/www/html

# Install required system packages
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    zlib1g-dev \
    librabbitmq-dev \
    && docker-php-ext-install zip \
    && pecl install amqp \
    && docker-php-ext-enable amqp \
    && rm -rf /var/www/html/*  # Remove existing files to prevent overwriting by COPY

# Copy composer.lock and composer.json
COPY composer.lock composer.json /var/www/html/

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy the entire Symfony application directory into the container
COPY . /var/www/html

# Set permissions for Symfony cache and logs directories
RUN chown -R www-data:www-data /var/www/html/var

# Expose port 8000 to the outside world
EXPOSE 8000

# Command to start the Symfony server
CMD ["php", "bin/console", "server:run", "0.0.0.0:8000"]
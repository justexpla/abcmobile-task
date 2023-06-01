FROM php:8.2-fpm AS base

# Set working directory
WORKDIR /var/www/auth-app

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add libraries
RUN apt update && apt install -y \
        git \
        curl \
        libpq-dev \
        libzip-dev \
        zip \
        unzip

# Add php extensions
RUN docker-php-ext-install pdo_pgsql bcmath zip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Copy existing application directory permissions
RUN usermod -u 1000 www-data

# Build for local development
FROM base AS local

# Add script to start application
COPY ./docker/php/start_local.sh /var/www/start.sh
RUN chmod 777 /var/www/start.sh

USER www-data
EXPOSE 9000

CMD ["/var/www/start.sh"]

# Build for production
FROM base AS production

# Add script to start application
COPY ./docker/php/start_prod.sh /var/www/start.sh
RUN chmod 777 /var/www/start.sh

USER www-data
EXPOSE 9000

CMD ["/var/www/start.sh"]

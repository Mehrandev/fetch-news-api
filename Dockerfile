# Use the official PHP image as a base
FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www/html

# Install system dependencies, including libonig-dev for mbstring
RUN apt-get update -o Acquire::Check-Valid-Until=false -o Acquire::Check-Date=false \
    && apt-get install -y --no-install-recommends \
    git \
    zip \
    unzip \
    cron \
    libonig-dev \
    procps \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install bcmath \
    && docker-php-ext-install mbstring \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer globally
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy existing application directory contents
COPY . /var/www/html

# Set permissions for Laravel directories
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Copy crontab file into the cron.d directory
COPY ./docker/crontab /etc/cron.d/laravel-cron

# Give execution rights on the cron job file
RUN chmod 0644 /etc/cron.d/laravel-cron

# Create the log file to be used by cron
RUN touch /var/log/cron.log

# Run both the Laravel server and cron using a custom script
COPY ./docker/start.sh /start.sh
RUN chmod +x /start.sh

# Set the startup command to run the custom script
CMD ["/start.sh"]

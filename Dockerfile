FROM php:8.4-cli

# 8.4+ is required: Laravel 13 + the locked Symfony 8 packages use
# the native Dom\HTMLDocument class that only ships in PHP 8.4.

# Install system dependencies + PHP extensions Filament / Laravel need.
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl pdo pdo_mysql zip mbstring xml bcmath \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]

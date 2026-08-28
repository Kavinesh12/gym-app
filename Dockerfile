FROM php:8.4-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    nodejs \
    npm \
    && docker-php-ext-install \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy project
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Install frontend dependencies and build Vite
RUN npm install
RUN npm run build

# Create SQLite database
RUN mkdir -p database \
    && touch database/database.sqlite

# Run Laravel migrations
RUN php artisan migrate --force

# Fix permissions
RUN chown -R www-data:www-data \
    /var/www/html/storage \
    /var/www/html/bootstrap/cache \
    /var/www/html/database

# Enable Apache rewrite
RUN a2enmod rewrite

# Apache configuration
COPY docker/apache.conf /etc/apache2/sites-available/000-default.conf

# Render uses port 80
EXPOSE 80

CMD ["apache2-foreground"]
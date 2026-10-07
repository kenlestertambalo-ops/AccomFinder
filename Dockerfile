# ============================================
# AccomFinder - Laravel Docker Configuration
# ============================================

# ============================================
# STAGE 1: Build Vite frontend
# ============================================
FROM node:20-alpine AS frontend

WORKDIR /app

# Copy package files
COPY package*.json ./

# Install frontend dependencies
RUN npm ci

# Copy frontend files
COPY resources ./resources
COPY public ./public
COPY vite.config.* ./

# Build Vite
RUN npm run build


# ============================================
# STAGE 2: Laravel / PHP
# ============================================
FROM php:8.2-cli

# Install Linux dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libicu-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    default-mysql-client \
    && docker-php-ext-install \
        pdo \
        pdo_mysql \
        mbstring \
        bcmath \
        intl \
        zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*


# ============================================
# Install Composer
# ============================================
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer


# ============================================
# Laravel working directory
# ============================================
WORKDIR /var/www


# ============================================
# COPY THE WHOLE LARAVEL APPLICATION FIRST
# ============================================
COPY . .


# ============================================
# Install Laravel dependencies
# ============================================
RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction \
    --prefer-dist


# ============================================
# Copy Vite production build
# ============================================
COPY --from=frontend /app/public/build ./public/build


# ============================================
# Create Laravel storage directories
# ============================================
RUN mkdir -p \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs


# ============================================
# Set permissions
# ============================================
RUN chmod -R 775 storage bootstrap/cache


# ============================================
# Render port
# ============================================
EXPOSE 10000


# ============================================
# Start Laravel
# ============================================
CMD ["sh", "-c", "php artisan serve --host=0.0.0.0 --port=${PORT:-10000}"]

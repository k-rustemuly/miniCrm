FROM php:8.4-fpm

# Установить зависимости
RUN apt-get update && apt-get install -y \
    git \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libjpeg-dev \
    libwebp-dev \
    zlib1g-dev \
    libzip-dev \
    libpq-dev \
    locales \
    vim \
    zip \
    jpegoptim optipng pngquant gifsicle \
    unzip \
    curl \
    nginx \
    supervisor \
    libicu-dev \
    libmagickwand-dev --no-install-recommends \
    && pecl install imagick \
    && docker-php-ext-enable imagick \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql -j$(nproc) gd \
    && docker-php-ext-install zip \
    && docker-php-ext-install intl \
    && docker-php-ext-install pdo_pgsql pgsql
# Очистить apt-get
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN pecl install redis \
    && docker-php-ext-enable redis

# Установка Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version=2.5.4

# Установка рабочей директории
WORKDIR /var/www

# Копирование файлов и установка владельца и прав доступа
COPY --chown=www-data:www-data . .

# Установка прав доступа для storage и bootstrap/cache
RUN chown -R www-data:www-data storage storage/logs bootstrap/cache
RUN chmod -R ug+rwx storage storage/logs bootstrap/cache

# Установка зависимостей Composer
RUN composer install --ignore-platform-reqs

# Запуск служб
RUN service nginx start && service supervisor start

# Команда по умолчанию
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/supervisord.conf"]

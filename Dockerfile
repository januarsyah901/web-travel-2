FROM php:8.2-fpm-alpine

RUN apk add --no-cache \
    nginx \
    supervisor \
    bash \
    git \
    unzip \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libwebp-dev \
    libxpm-dev \
    libzip-dev \
    oniguruma-dev \
    nodejs \
    npm \
    icu-dev \
    libtool \
    make \
    gcc \
    g++ \
    autoconf \
    pcre-dev

# PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) \
        bcmath \
        gd \
        mbstring \
        mysqli \
        pdo_mysql \
        zip \
        opcache \
        intl

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# PHP config
RUN { \
      echo 'opcache.memory_consumption=128'; \
      echo 'opcache.interned_strings_buffer=8'; \
      echo 'opcache.max_accelerated_files=10000'; \
      echo 'opcache.validate_timestamps=0'; \
    } > /usr/local/etc/php/conf.d/opcache.ini

COPY nginx.conf /etc/nginx/http.d/default.conf
COPY supervisor.conf /etc/supervisord.conf
COPY start.sh /start.sh
RUN chmod +x /start.sh

COPY composer.json composer.lock ./
RUN composer install --no-dev --no-autoloader --no-scripts --no-progress --prefer-dist

COPY . .

RUN composer dump-autoload --optimize \
    && if [ -f package.json ]; then npm ci --include=dev || npm install; npm run build; fi \
    && rm -rf node_modules \
    && rm -rf /tmp/*

EXPOSE 80
CMD ["/start.sh"]

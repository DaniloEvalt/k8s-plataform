FROM php:8.2-apache-alpine3.18

# Instalar dependências
RUN apk add --no-cache \
    libzip-dev \
    zip \
    unzip \
    git \
    icu-dev \
    oniguruma-dev \
    linux-headers \
    && docker-php-ext-install \
    pdo_mysql \
    zip \
    intl \
    opcache \
    mbstring

# Configurar o Apache
RUN sed -ri -e 's!^(\s*CustomLog)\s+\S+!\1 /proc/self/fd/1!g' \
    -e 's!^(\s*ErrorLog)\s+\S+!\1 /proc/self/fd/2!g' \
    "/etc/apache2/httpd.conf"

# Configurar o PHP-FPM
RUN set -ex \
    && cd /usr/local/etc \
    && if [ -d php-fpm.d ]; then \
        sed -i 's/pm.max_children = 5/pm.max_children = 20/g' \
            php-fpm.d/www.conf \
        && sed -i 's/pm.start_servers = 2/pm.start_servers = 5/g' \
            php-fpm.d/www.conf \
        && sed -i 's/pm.min_spare_servers = 1/pm.min_spare_servers = 5/g' \
            php-fpm.d/www.conf \
        && sed -i 's/pm.max_spare_servers = 3/pm.max_spare_servers = 10/g' \
            php-fpm.d/www.conf \
    fi

# Configurar o OPcache
RUN { \
        echo 'opcache.memory_consumption=128'; \
        echo 'opcache.interned_strings_buffer=8'; \
        echo 'opcache.max_accelerated_files=4000'; \
        echo 'opcache.revalidate_freq=60'; \
        echo 'opcache.fast_shutdown=1'; \
        echo 'opcache.enable_cli=1'; \
    } > /usr/local/etc/php/conf.d/opcache-recommended.ini

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar diretório de trabalho
WORKDIR /var/www/html

# Copiar código da aplicação
COPY . .

# Instalar dependências do Composer
RUN composer install --no-dev --optimize-autoloader

# Configurar permissões
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage

# Expor porta
EXPOSE 80

# Iniciar Apache
CMD ["apache2-foreground"]

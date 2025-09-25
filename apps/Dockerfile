FROM php:8.2-fpm-alpine

# Instalar nginx
RUN apk add --no-cache nginx

# Copiar arquivos PHP
COPY index.php /var/www/html/
COPY health-check.php /var/www/html/

# Configurar nginx
RUN echo 'server { \n\
    listen 80; \n\
    root /var/www/html; \n\
    index index.php; \n\
    \n\
    location / { \n\
        try_files $uri $uri/ /index.php?$query_string; \n\
    } \n\
    \n\
    location ~ \.php$ { \n\
        fastcgi_pass 127.0.0.1:9000; \n\
        fastcgi_index index.php; \n\
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name; \n\
        include fastcgi_params; \n\
    } \n\
}' > /etc/nginx/http.d/default.conf

# Script de inicialização
COPY docker-entrypoint.sh /
RUN chmod +x /docker-entrypoint.sh

EXPOSE 80
ENTRYPOINT ["/docker-entrypoint.sh"]
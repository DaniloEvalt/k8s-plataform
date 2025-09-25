#!/bin/sh
set -e

# Copiar os arquivos PHP
cp /configmap/index.php /app/
cp /configmap/health-check.php /app/

# Ajustar permissões
chown -R www-data:www-data /app
chmod -R 644 /app/*

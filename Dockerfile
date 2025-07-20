FROM php:8.2-cli

# Instala dependências
RUN apt-get update && apt-get install -y \
    git curl zip unzip libzip-dev libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl

# Instala Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Define diretório de trabalho
WORKDIR /var/www

# Copia os arquivos
COPY . .

# Instala dependências PHP
RUN composer install --no-interaction --optimize-autoloader

# Permissões
RUN chmod -R 775 storage bootstrap/cache

# Porta padrão da aplicação Laravel (Artisan serve)
EXPOSE 8000

# Comando padrão (substituído nos serviços abaixo)
CMD php artisan serve --host=0.0.0.0 --port=8000

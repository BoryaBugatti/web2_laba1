FROM php:8.1-fpm

# Установка необходимых расширений PHP
RUN docker-php-ext-install pdo pdo_mysql

# Установка рабочей директории
WORKDIR /var/www/html

# Копирование исходного кода
COPY . .

# Установка прав доступа
RUN chown -R www-data:www-data /var/www/html
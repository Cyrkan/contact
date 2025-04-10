# Вихідне PHP-оточення
FROM php:8.2-cli

# Встановлюємо необхідні розширення (для mail, якщо потрібно)
RUN apt-get update && apt-get install -y \
    sendmail \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo mbstring exif pcntl bcmath gd

# Копіюємо файли
COPY . /var/www/html

# Встановлюємо робочу директорію
WORKDIR /var/www/html/public

# Відкриваємо порт 80
EXPOSE 80

# Запускаємо PHP built-in сервер
CMD ["php", "-S", "0.0.0.0:80", "-t", "."]
FROM php:8.2-apache

# 1. تثبيت أدوات النظام والاعتمادات اللازمة
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo pdo_mysql gd

# 2. تثبيت Composer داخل الحاوية
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 3. تعديل إعدادات Apache لتشغيل مجلد public
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

# 4. نسخ ملفات المشروع
COPY . /var/www/html
WORKDIR /var/www/html

# 5. تثبيت مكتبات PHP (vendor)
RUN composer install --no-interaction --optimize-autoloader --no-dev

# 6. إعطاء الصلاحيات اللازمة
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 7. تشغيل الـ Migration ثم السيرفر
CMD php artisan migrate --force && apache2-foreground

EXPOSE 80
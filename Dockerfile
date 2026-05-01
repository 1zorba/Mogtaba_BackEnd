FROM php:8.2-apache

# تثبيت الإضافات اللازمة
RUN docker-php-ext-install pdo pdo_mysql

# نسخ ملفات المشروع
COPY . /var/www/html
WORKDIR /var/www/html

# إعطاء الصلاحيات للمجلدات المطلوبة
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# تنفيذ الـ Migration تلقائياً عند بدء التشغيل
CMD php artisan migrate --force && apache2-foreground

EXPOSE 80
# استخدام نسخة PHP الرسمية مع Apache
FROM php:8.2-apache

# تثبيت الإضافات الضرورية لـ Laravel و MySQL
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl

# تثبيت إضافات PHP المطلوبة
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# تفعيل خاصية mod_rewrite في Apache (ضرورية لـ Laravel)
RUN a2enmod rewrite

# ضبط المجلد الرئيسي للعمل
WORKDIR /var/www/html

# نسخ ملفات المشروع إلى الحاوية
COPY . .

# تثبيت Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-interaction --optimize-autoloader --no-dev

# ضبط الصلاحيات لمجلدات Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# تعديل إعدادات Apache لتوجه إلى مجلد public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# فتح المنفذ 80
EXPOSE 80

# السطر الذهبي: تنفيذ التهجير، زرع البيانات، وتشغيل السيرفر
# تم استخدام --force لأننا في وضع الإنتاج (Production)
 # تأكد من استخدام هذا التنسيق لضمان استمرار تشغيل الحاوية
ENTRYPOINT ["/bin/sh", "-c", "php artisan migrate:fresh --force --seed && php artisan storage:link && apache2-foreground"]
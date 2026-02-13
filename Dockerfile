# استخدام نسخة PHP الرسمية مع Apache
FROM php:8.2-apache

# 1. تثبيت الحزم الضرورية للنظام وإضافات PHP المطلوبة
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# 2. حل مشكلة (More than one MPM loaded) - مهم جداً لـ Railway
# نقوم بتعطيل mpm_event و mpm_worker وتفعيل mpm_prefork لضمان استقرار Apache
RUN a2dismod mpm_event mpm_worker || true \
    && a2enmod mpm_prefork \
    && a2enmod rewrite

# 3. تعديل مسار المجلد العام ليشير إلى public بدلاً من html
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# 4. تثبيت Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 5. تثبيت Node.js و NPM (لبناء ملفات CSS و JS في لارافيل 12)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# 6. تحديد مجلد العمل ونسخ ملفات المشروع
WORKDIR /var/www/html
COPY . .

# 7. تثبيت مكتبات PHP (Composer)
RUN composer install --no-interaction --optimize-autoloader --no-dev

# 8. تثبيت مكتبات Node وبناء ملفات Vite (Assets Build)
RUN npm install && npm run build

# 9. ضبط الصلاحيات للمجلدات (لتجنب خطأ 500 أو Permission Denied)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 10. فتح المنفذ 80
EXPOSE 80

# 11. أمر التشغيل النهائي (تنظيف إعدادات MPM الزائدة ثم البدء)
CMD ["bash", "-c", "rm -f /etc/apache2/mods-enabled/mpm_event.* /etc/apache2/mods-enabled/mpm_worker.* && apache2-foreground"]
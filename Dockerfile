# استخدام صورة PHP رسمية مع Apache
FROM php:8.2-apache

# 1. تثبيت الحزم الضرورية للنظام
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev

# 2. تنظيف ملفات الكاش
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# 3. تثبيت إضافات PHP المطلوبة لـ Laravel
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# 4. حل مشكلة (More than one MPM loaded) وتفعيل الـ Rewrite
# نقوم بتعطيل الوحدات المتعارضة وتفعيل mpm_prefork المتوافقة مع PHP
RUN a2dismod mpm_event mpm_worker || true \
    && a2enmod mpm_prefork \
    && a2enmod rewrite

# 5. تعديل مجلد الروت ليشير إلى public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# 6. تثبيت Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 7. تثبيت Node.js و NPM (لبناء ملفات Vite)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# 8. تحديد مجلد العمل
WORKDIR /var/www/html

# 9. نسخ ملفات المشروع
COPY . .

# 10. تثبيت مكتبات PHP
RUN composer install --no-interaction --optimize-autoloader --no-dev

# 11. تثبيت مكتبات Node وبناء ملفات الـ Assets
RUN npm install && npm run build

# 12. ضبط الصلاحيات لمجلدات التخزين والـ Cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 13. المنفذ
EXPOSE 80

# 14. أمر التشغيل النهائي مع تنظيف إعدادات MPM الزائدة
CMD ["bash", "-c", "rm -f /etc/apache2/mods-enabled/mpm_event.* /etc/apache2/mods-enabled/mpm_worker.* && apache2-foreground"]
# ใช้ภาพของ PHP: Apache
FROM php:7.4-apache

# ติดตั้งส่วนขยาย PostgreSQL
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo_pgsql

# คัดลอกไฟล์ทั้งหมดจากโฟลเดอร์ปัจจุบันไปยัง /var/www/html ใน Docker container
COPY . /var/www/html/

# ตั้งค่าให้ Apache รับฟังบนพอร์ต 80
EXPOSE 80

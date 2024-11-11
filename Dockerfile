# FROM webdevops/php-nginx:8.1-alpine

# # Installation dans votre Image du minimum pour que Docker fonctionne
# RUN apk add oniguruma-dev libxml2-dev
# RUN docker-php-ext-install \
#         bcmath \
#         ctype \
#         fileinfo \
#         mbstring \
#         pdo_mysql \
#         xml

# # Installation dans votre image de Composer
# COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# # Installation dans votre image de NodeJS
# RUN apk add nodejs npm

# ENV WEB_DOCUMENT_ROOT /app/public
# ENV APP_ENV production
# WORKDIR /app
# COPY . .

# # On copie le fichier .env.example pour le renommer en .env
# # Vous pouvez modifier le .env.example pour indiquer la configuration de votre site pour la production
# RUN cp -n .env.example .env

# # Installation et configuration de votre site pour la production
# # https://laravel.com/docs/10.x/deployment#optimizing-configuration-loading
# RUN composer install --no-interaction --optimize-autoloader --no-dev
# # Generate security key
# RUN php artisan key:generate
# # Optimizing Configuration loading
# RUN php artisan config:cache
# # Optimizing Route loading
# RUN php artisan route:cache
# # Optimizing View loading
# RUN php artisan view:cache
# # 
# RUN yes | php artisan migrate:refresh

# # Compilation des assets de Breeze (ou de votre site)
# RUN npm install
# RUN npm run build

# RUN chown -R application:application .

# Utilise l'image officielle PHP avec Apache pour Laravel
FROM php:8.1-apache

# Installe les extensions PHP nécessaires
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Installe Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# RUN php artisan key:generate
# Optimizing Configuration loading
RUN php artisan config:cache
# Optimizing Route loading
RUN php artisan route:cache
# Optimizing View loading
RUN php artisan view:cache

# Copie le projet Laravel dans le container
COPY . /var/www/html

# Définir le dossier de travail
WORKDIR /var/www/html

# Donne les droits de propriétaire à Apache
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage

# Expose le port 80
EXPOSE 80

# Démarre Apache
CMD ["apache2-foreground"]

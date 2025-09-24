FROM php:8.1-apache

# Installer les dépendances système
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurer Apache
RUN a2enmod rewrite
COPY docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier les fichiers de configuration d'abord
COPY composer.json composer.lock ./

# Installer les dépendances PHP (avec dev pour le développement)
RUN composer install --optimize-autoloader --no-scripts

# Copier le reste de l'application
COPY . .

# Exécuter les scripts post-installation
RUN composer run-script post-install-cmd --no-interaction

# Configurer les permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 777 /var/www/html/var

# Exposer le port 80
EXPOSE 80

# Commande par défaut
CMD ["apache2-foreground"]

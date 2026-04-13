FROM rockylinux:9

# 1. Aggiornamento sistema
RUN dnf -y update && \
    dnf upgrade -y && \
    dnf clean all

# 2. Installazione EPEL e CRB
RUN dnf -y install epel-release && \
    dnf config-manager --set-enabled crb

# 3. Installazione tool e librerie
# IMPORTANTE: Ho aggiunto 'unzip' che mancava e serve a Composer
RUN dnf -y install --setopt=tsflags=nodocs \
    dnf-plugins-core wget nano dialog sqlite-libs mysql zlib libzip libicu git curl libcurl openssl zip unzip make \
    gcc gcc-c++ autoconf automake vim libzip mod_fcgid tar bzip kernel-headers \
    perl psmisc cronie cronie-anacron crontabs elfutils-libelf-devel \
    libpng libjpeg icu libX11 libXext libXrender xorg-x11-fonts-Type1 xorg-x11-fonts-75dpi ghostscript --skip-broken && \
    dnf clean all

# 4. Setup TimeZone
RUN ln -sf /usr/share/zoneinfo/Europe/Rome /etc/localtime

# 5. Installazione Apache + PHP
RUN dnf -y install --setopt=tsflags=nodocs httpd httpd-tools php-pear php-devel make openssl-devel && dnf clean all

# 6. Reset PHP module e installazione PHP 8.2
# IMPORTANTE: Ho aggiunto 'fileinfo', 'process', 'ctype' che servono a Laravel
RUN dnf -y module reset php \
    && dnf -y module enable php:8.2 \
    && dnf -y install php php-{common,curl,pdo,mysqlnd,json,mbstring,soap,xml,gd,bcmath,cli,pear,devel,intl,openssl,pdo_mysql,pecl-zip,fpm,zip,fileinfo,process,ctype,opcache} --allowerasing

# 7. Installazione Node.js 20
RUN dnf module install -y nodejs:20 && \
    dnf clean all

# 7b. Installazione Supervisor (per gestire httpd, php-fpm e reverb)
RUN dnf install -y supervisor && \
    dnf clean all

# 8. Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"

# 9. Setup directory PHP-FPM e Configurazione OPcache
RUN mkdir -p /run/php-fpm && \
    chown -R apache:apache /run/php-fpm && \
    chmod -R 755 /run/php-fpm && \
    echo '[opcache]' > /etc/php.d/10-opcache.ini && \
    echo 'opcache.enable=1' >> /etc/php.d/10-opcache.ini && \
    echo 'opcache.memory_consumption=256' >> /etc/php.d/10-opcache.ini && \
    echo 'opcache.interned_strings_buffer=16' >> /etc/php.d/10-opcache.ini && \
    echo 'opcache.max_accelerated_files=10000' >> /etc/php.d/10-opcache.ini && \
    echo 'opcache.revalidate_freq=0' >> /etc/php.d/10-opcache.ini

# 10. Set working directory
WORKDIR /var/www/html

# 11. Copia file Composer per cache
COPY composer.json composer.lock ./

# 12. Installazione dipendenze Composer
# --ignore-platform-reqs aiuta se sviluppi su Windows/Mac e deploy su Linux
RUN composer install --no-scripts --no-autoloader --ignore-platform-reqs

# 13. Copia del progetto
COPY . .
# Sovrascriviamo la conf di apache
COPY vhost.conf /etc/httpd/conf.d/vhost.conf

# 14. Copia del file supervisord.conf nella posizione corretta
RUN mkdir -p /etc/supervisor/conf.d
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# 15. Permessi finali e dump autoload
RUN composer dump-autoload --optimize --no-scripts
RUN chown -R apache:apache /var/www/html
RUN chmod -R 775 storage bootstrap/cache

# 16. Migrazioni all'avvio + Supervisor
RUN echo '#!/bin/bash' > /usr/local/bin/docker-entrypoint.sh && \
    echo 'set -e' >> /usr/local/bin/docker-entrypoint.sh && \
    echo 'echo "Avvio Migrazioni..."' >> /usr/local/bin/docker-entrypoint.sh && \
    echo 'php artisan migrate --force' >> /usr/local/bin/docker-entrypoint.sh && \
    echo 'php artisan config:clear' >> /usr/local/bin/docker-entrypoint.sh && \
    echo 'php artisan cache:clear' >> /usr/local/bin/docker-entrypoint.sh && \
    echo 'echo "Avvio Supervisor..."' >> /usr/local/bin/docker-entrypoint.sh && \
    echo 'exec supervisord -n -c /etc/supervisor/conf.d/supervisord.conf' >> /usr/local/bin/docker-entrypoint.sh && \
    chmod +x /usr/local/bin/docker-entrypoint.sh

EXPOSE 80 8081

ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]
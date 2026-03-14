FROM php:8.3-apache

ARG UID=1001
ARG GID=1001

# Dependências + extensões PHP comuns do Laravel
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libonig-dev libicu-dev \
    libxml2-dev default-mysql-client curl \
  && docker-php-ext-install pdo_mysql mbstring zip intl \
  && a2enmod rewrite headers \
  && rm -rf /var/lib/apt/lists/*

# Ajusta DocumentRoot (Apache)
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
  && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Composer (binário)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Usuário dentro do container com o mesmo UID/GID do host (evita "sudo pra salvar")
RUN groupadd -g ${GID} appgroup \
  && useradd -u ${UID} -g ${GID} -m appuser

WORKDIR /var/www/html

# Permissões típicas do Laravel
RUN mkdir -p /var/www/html/storage /var/www/html/bootstrap/cache \
  && chown -R appuser:appgroup /var/www/html

USER appuser

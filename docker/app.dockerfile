FROM php:8.2.28-fpm-bookworm

RUN apt-get update && apt-get install --no-install-recommends -y \
        less \
        zlib1g-dev \
        libzip-dev \
        openssh-server

# ZIP
RUN docker-php-ext-install zip

ARG WITH_XDEBUG=false
ARG XDEBUG_TRIGGER_PROFILER=false
ARG XDEBUG_PROFILER_DIR=/var/xdebug

RUN if [ ${WITH_XDEBUG} = "true" ] ; then \
        pecl install xdebug-3.2.0; \
        docker-php-ext-enable xdebug; \
        echo "error_reporting = E_ALL" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
        echo "display_startup_errors = On" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
        echo "display_errors = On" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
        echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
        echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
        if [ ${XDEBUG_TRIGGER_PROFILER} = "true" ] ; then \
            echo xdebug.mode=profile >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
            echo xdebug.start_with_request=trigger >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
            echo xdebug.output_dir=${XDEBUG_PROFILER_DIR} >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
        fi ; \
    fi ;

# Node
RUN apt-get --allow-releaseinfo-change update \
    && curl -sL https://deb.nodesource.com/setup_18.x | bash -

# Misc
RUN apt-get update && apt-get install -y \
    nodejs \
    yarn \
    libmcrypt-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libzip-dev \
    libssl-dev \
    zip \
    unzip \
    mariadb-client \
    libmagickwand-dev \
    ghostscript --no-install-recommends \
    imagemagick \
    && pecl install imagick \
    && docker-php-ext-enable imagick \
    && docker-php-ext-configure gd \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo_mysql \
    && pecl install mcrypt-1.0.6 \
    && docker-php-ext-enable mcrypt \
    && docker-php-ext-install zip \
    && docker-php-ext-install intl \
    && docker-php-ext-install exif \
    && docker-php-ext-configure ftp --with-openssl-dir=/usr \
    && docker-php-ext-install ftp

# LDAP
RUN apt-get update && \
    apt-get install libldap2-dev -y && \
    rm -rf /var/lib/apt/lists/* && \
    docker-php-ext-configure ldap --with-libdir=lib/$(gcc --dumpmachine)/ && \
    docker-php-ext-install ldap

# Oracle Support
# for ARM based Hosts
RUN apt-get update && apt-get -y install wget libarchive-tools libaio1
RUN if [ $(arch) = "aarch64" ] ; then \
    wget -qO- https://download.oracle.com/otn_software/linux/instantclient/1919000/instantclient-basic-linux.arm64-19.19.0.0.0dbru.zip | bsdtar -xvf- -C /usr/local && \
    wget -qO- https://download.oracle.com/otn_software/linux/instantclient/1919000/instantclient-sdk-linux.arm64-19.19.0.0.0dbru.zip | bsdtar -xvf-  -C /usr/local && \
    wget -qO- https://download.oracle.com/otn_software/linux/instantclient/1919000/instantclient-sqlplus-linux.arm64-19.19.0.0.0dbru.zip | bsdtar -xvf- -C /usr/local && \
    echo "installed"; \
fi ;
# for X86 based hosts
RUN if [ $(arch) = "x86_64" ] ; then \
    wget -qO- https://download.oracle.com/otn_software/linux/instantclient/218000/instantclient-basic-linux.x64-21.8.0.0.0dbru.zip | bsdtar -xvf- -C /usr/local && \
    wget -qO- https://download.oracle.com/otn_software/linux/instantclient/218000/instantclient-sdk-linux.x64-21.8.0.0.0dbru.zip | bsdtar -xvf-  -C /usr/local && \
    wget -qO- https://download.oracle.com/otn_software/linux/instantclient/218000/instantclient-sqlplus-linux.x64-21.8.0.0.0dbru.zip | bsdtar -xvf- -C /usr/local && \
    echo "installed"; \
fi ;

# Make symbolic link for instantclient and remove existing ones within that shipped by Oracle
# for ARM based Hosts
RUN if [ $(arch) = "aarch64" ] ; then \
    ln -s /usr/local/instantclient_19_19 /usr/local/instantclient && \
    rm /usr/local/instantclient/libclntsh.so && \
    rm /usr/local/instantclient/libclntsh.so.10.1 && \
    rm /usr/local/instantclient/libclntsh.so.11.1 && \
    rm /usr/local/instantclient/libclntsh.so.12.1 && \
    rm /usr/local/instantclient/libclntsh.so.18.1 && \
    rm /usr/local/instantclient/libocci.so && \
    rm /usr/local/instantclient/libocci.so.10.1 && \
    rm /usr/local/instantclient/libocci.so.11.1 && \
    rm /usr/local/instantclient/libocci.so.12.1 && \
    rm /usr/local/instantclient/libocci.so.18.1 && \
   echo "installed"; \
fi ;
# for X86 based hosts
RUN if [ $(arch) = "x86_64" ] ; then \
    ln -s /usr/local/instantclient_21_8 /usr/local/instantclient && \
    rm /usr/local/instantclient/libclntsh.so && \
    rm /usr/local/instantclient/libclntsh.so.10.1 && \
    rm /usr/local/instantclient/libclntsh.so.11.1 && \
    rm /usr/local/instantclient/libclntsh.so.12.1 && \
    rm /usr/local/instantclient/libclntsh.so.18.1 && \
    rm /usr/local/instantclient/libclntsh.so.19.1 && \
    rm /usr/local/instantclient/libclntsh.so.20.1 && \
    rm /usr/local/instantclient/libclntshcore.so && \
    rm /usr/local/instantclient/libclntshcore.so.12.1 && \
    rm /usr/local/instantclient/libclntshcore.so.18.1 && \
    rm /usr/local/instantclient/libclntshcore.so.19.1 && \
    rm /usr/local/instantclient/libclntshcore.so.20.1 && \
    rm /usr/local/instantclient/libocci_gcc53.so && \
    rm /usr/local/instantclient/libocci.so && \
    rm /usr/local/instantclient/libocci.so.10.1 && \
    rm /usr/local/instantclient/libocci.so.11.1 && \
    rm /usr/local/instantclient/libocci.so.12.1 && \
    rm /usr/local/instantclient/libocci.so.18.1 && \
    rm /usr/local/instantclient/libocci.so.19.1 && \
    rm /usr/local/instantclient/libocci.so.20.1 && \
   echo "installed"; \
fi ;

RUN ln -s /usr/local/instantclient/libclntsh.so.* /usr/local/instantclient/libclntsh.so && \
 ln -s /usr/local/instantclient/lib* /usr/lib && \
 ln -s /usr/local/instantclient/sqlplus /usr/bin/sqlplus && \
 docker-php-ext-configure oci8 --with-oci8=instantclient,/usr/local/instantclient && \
 docker-php-ext-install oci8 && \
 rm -rf /var/lib/apt/lists/* && \
 php -v

RUN wget http://php.net/distributions/php-8.2.28.tar.gz && \
    mkdir php_oci && \
    mv php-8.2.28.tar.gz ./php_oci

WORKDIR php_oci

RUN tar xfvz php-8.2.28.tar.gz
WORKDIR php-8.2.28/ext/pdo_oci
RUN phpize && \
    ./configure --with-pdo-oci=instantclient,/usr/local/instantclient,21.8 && \
    make && \
    make install && \
    echo extension=pdo_oci.so > /usr/local/etc/php/conf.d/pdo_oci.ini && \
    php -v

ENV TIMEZONE=America/Chicago
ENV TZ=America/Chicago

RUN touch /usr/local/etc/php/conf.d/dates.ini \
    && echo "date.timezone = $TZ;" >> /usr/local/etc/php/conf.d/dates.ini

RUN touch /usr/local/etc/php/conf.d/docker-php-memlimit.ini \
    && echo "memory_limit = 128M" >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini

RUN touch /usr/local/etc/php/conf.d/docker-php-upload-settings.ini \
    && echo "max_execution_time = 30" >> /usr/local/etc/php/conf.d/docker-php-upload-settings.ini \
    && echo "post_max_size = 512M" >> /usr/local/etc/php/conf.d/docker-php-upload-settings.ini \
    && echo "upload_max_filesize = 256M" >> /usr/local/etc/php/conf.d/docker-php-upload-settings.ini

# Redirect PHP Errors
RUN echo "log_errors = On" >> /usr/local/etc/php/conf.d/php.ini \
    && echo "error_log = /proc/self/fd/2" >> /usr/local/etc/php/conf.d/php.ini

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone
# Composer
RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer
RUN apt-get update && apt-get install -y
RUN chown -R www-data:www-data /var/www

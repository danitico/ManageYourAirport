#!/bin/bash
#Se procede a instalar php
sudo add-apt-repository ppa:ondrej/php
sudo apt-get update
sudo apt-get  install php7.1 php7.1-bcmath php7.1-cli php7.1-common php7.1-curl php7.1-gd php7.1-gmp php7.1-intl php7.1-json php7.1-mbstring php7.1-mysql php7.1-opcache php7.1-pgsql php7.1-phpdbg php7.1-readline php7.1-sqlite3 php7.1-xml php7.1-xmlrpc php7.1-zip php-xdebug

#Vemos si composer está instalado
command -v composer >/dev/null 2>&1 || { echo >&2 "Composer no está instalado. Ejecuta la orden sudo apt-get install composer"; exit 1; }

#Se procede a instalar los paquetes de composer
echo "Se procede a instalar los paquetes necesarios desde composer"
composer install
echo "Se han instalado todos los paquetes"

echo "Se procede a crear el esquema de la base de datos"
php bin/console doc:schema:create

echo "Se procede a cargar los fixtures"
php bin/console doc:fix:load

echo "Para iniciar el servidor se debe de poner el siguiente comando"
echo "php bin/console server:run"



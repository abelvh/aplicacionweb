#!/bin/bash
cd /tmp
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer

cd /var/www/html/bzbackup
mkdir -p app/cache app/logs
setfacl -R -m u:www-data:rwX  u:`whoami`:rwX app/cache app/logs
setfacl -dR -m u:www-data:rwX  u:`whoami`:rwX app/cache app/logs
composer install --no-dev --optimize-autoloader
php app/console cache:clear --env=prod --no-debug